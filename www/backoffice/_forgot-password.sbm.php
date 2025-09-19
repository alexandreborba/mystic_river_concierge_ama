<?php
@session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../src/Parameters.php';
require_once __DIR__. '/../src/Functions.php';
require_once __DIR__. '/../src/Tools/Translator.php';
//include_once __DIR__. "/__session_verify.php";
ini_set("display_errors", 0);
#error_reporting(E_ALL);

use Src\Models\SysManagers;
use Src\Mail\Email;

if(isset($_POST['action']) && $_POST['action'] == 'forgot' && isset($_POST['forgotEmail']) && !empty($_POST['forgotEmail'])) {

    $managerEmail = f_lower(filter_var(trim($_POST["forgotEmail"]), FILTER_SANITIZE_EMAIL));
    // f_dump($_POST);
    // echo $managerEmail; exit;

    try {
        // verifica se o email existe
        $manager = (new SysManagers())->find("managerEmail = :email AND managerStatus=:st", "email={$managerEmail}&st=1")->fetch();
        // f_dump($manager); exit;
        $managerUUID = $manager->managerUUID;
        $managerName = $manager->managerName;
        $managerEmail = $manager->managerEmail;

        if($manager){
            // envia email para o utilizador
            $email_subject = SUBJECT_EMAIL_FORGOT_PASSWORD;
            $url = PROTOCOL.WEBHOST;
            $reset_target = "<a href='{$url}/manager/reset-your-password?ref=".f_encode($managerUUID)."'>Reset da Password</a>";
            $email_body = "Olá, <br><br>Para fazer o reset da sua Password clique no link abaixo:<br><br>{$reset_target}<br><br>Com os Melhores Cumprimentos,<br><strong>".EMAIL_FOOTER_FORGOT_PASSWORD_TXT."</strong>";
            $email_recipient_name = $managerName;
            $email_to = $managerEmail;

            $sendMail = new Email();

            $sendMail->add(
                "{$email_subject}", // Subject
                "{$email_body}", // Body
                "{$email_recipient_name}", // recipient name
                "{$email_to}" // recipient email
            )->send();
        
            if ($sendMail->error()) {
                echo $sendMail->error()->getMessage();
                die();
            }else{
                $manager->managerPSWReset = 1;
                if($manager->save()){
                    // redirecionar para a pagina de login
                    $_SESSION[CONTAINER_NAME."_msg"]["text"] = MESSAGE_MANAGER_FORGOT_PASSWORD_CONFIRM;
                    //f_dump($_SESSION);
                    sleep(1);
                } // endif save
                
            } // endif sendMail
            
        }
    } catch (\Throwable $e) {
        echo $e->getMessage();
    } // end try
}else{
    echo "Erro";
}
@header("Location: .");
echo f_goto(".");

?>