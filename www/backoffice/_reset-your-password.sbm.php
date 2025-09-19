<?php

@session_start();
require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../src/Parameters.php';
require_once __DIR__. '/../src/Functions.php';
require_once __DIR__. '/../src/Tools/Translator.php';
// include_once __DIR__. "/__session_verify.php";
ini_set("display_errors", 0);
#error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use Src\Mail\Email;

use Src\Models\SysManagers;
use Src\Models\SysLogs;

if(isset($_POST['action']) && $_POST['action'] == 'reset' && isset($_POST['resetPassword']) && !empty($_POST['resetUUID'])) {

    // LOG
    $log = new SysLogs();
    $log->logAction = 'send';
    $log->logDateTime = date('Y-m-d H:i:s');
    #$log->managerUUID = f_decode($_SESSION[CONTAINER_NAME."_mUUID"]);
    $log->logIP = f_ip();
    $log->logPage = "reset-your-password.sbm";
    $log->logData = json_encode($_POST);
    #$log->created_by = f_decode($_SESSION[CONTAINER_NAME."_mID"]);
    $log->logUUID = Uuid::uuid4();

    unset($_POST['action']);
    unset($_POST['resetPasswordConfirm']);
    // f_dump($_POST);
    $managerUUID = f_decode($_POST['resetUUID']);
    // echo $managerUUID;
    $manager = (new SysManagers())->find("managerUUID = :uuid AND managerStatus=:st", "uuid={$managerUUID}&st=1")->fetch();
    $manager->managerPSWHash = f_md5Invert(trim($_POST['resetPassword']));
    $manager->managerPSWReset = 0;

    if (!$manager->save()) {
        $_SESSION[CONTAINER_NAME."_messages_form"]["tp"] = 'error';
        $_SESSION[CONTAINER_NAME."_messages_form"]["text"] = 'Erro ao Alterar a Password'.$manager->fail()->getMessage();
        $log->logActionResult = 'Fail!';
        $log->save(); // save log
        if ($manager->fail()) {
            # echo 'erro !'.BR;
            $error = $manager->fail()->getMessage();
            echo $error.BR;
            f_dump($manager->data());
            $_SESSION['error']["page"] = "_reset-your-password.sbm";
            $_SESSION['error']["data"] = $error;
            die();
        }
    } else {
        $_SESSION[CONTAINER_NAME."_messages_form"]["tp"] = 'success';
        $_SESSION[CONTAINER_NAME."_messages_form"]["text"] = 'Password alterada com sucesso.';

        $sendMail = new Email();
        $email_subject = SUBJECT_EMAIL_RESET_PASSWORD;
        
        $email_body = "Olá, <br><br>Sua Password foi alterada com Sucesso!<br><br>Com os Melhores Cumprimentos,<br><strong>".EMAIL_FOOTER_FORGOT_PASSWORD_TXT."</strong>";
        $email_recipient_name = $manager->managerName;
        $email_to = $manager->managerEmail;

            $sendMail->add(
                "{$email_subject}", // Subject
                "{$email_body}", // Body
                "{$email_recipient_name}", // recipient name
                "{$email_to}" // recipient email
            )->send();
        
            if ($sendMail->error()) {
                echo $sendMail->error()->getMessage();
                $log->logActionResult = 'Fail!';
                $log->save(); // save log
                die();
            }else{
                $_SESSION[CONTAINER_NAME."_msg"]["text"] = MESSAGE_MANAGER_RESET_PASSWORD_CONFIRM;
                $log->logActionResult = 'Success!';
            }
    }
}
$log->save(); // save log
echo f_goto('.');