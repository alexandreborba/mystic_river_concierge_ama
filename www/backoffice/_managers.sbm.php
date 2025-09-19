<?php
@session_start();
// echo '<pre>'.json_encode($_SESSION).'</pre>';exit;
require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../src/Parameters.php';
require_once __DIR__. '/../src/Functions.php';
require_once __DIR__. '/../src/Tools/Translator.php';
include_once __DIR__. "/__session_verify.php";
ini_set("display_errors", 0);
#error_reporting(E_ALL);

use Ramsey\Uuid\Uuid;
use Src\Models\SysLogs;
use Src\Models\SysManagers;

@define('NEXT_PAGE', '_managers.lst');

// echo '<pre>'.json_encode($_POST).'</pre>'.BR; #exit;
#echo '<pre>'.json_encode($_SESSION).'</pre>'.BR; exit;
# exit;

if ($_POST["action"]) {

    $_POST["managerAdm"] = ($_POST["managerAdm"]) ? 1 : 0;

    $_POST["managerPSWHash"] = (!empty(trim($_POST["managerPSWHashNew"]))) ? f_md5Invert(trim($_POST["managerPSWHashNew"])) : trim($_POST["managerPSWHash"]);
    unset($_POST["managerPSWHashNew"]);

    $_POST["managerName"] = f_upper(trim($_POST["managerName"]));

    foreach ($_POST as $field => $value) {
        ${$field} = ($field !== "") ? trim($value) : null;
    }

    unset($_POST["action"]);

    $pageTitle = 'Administrador/a '.$managerName;

    $goTo = NEXT_PAGE;

    $id = ($managerID) ? $managerID : null;
    switch ($action) {
        case "ins":
            $manager = new SysManagers();
            #$NewUUID = Uuid::uuid4();
            //$area->created_by = $_SESSION['mRef'];
            $manager->created_by = ($_SESSION['mRef']) ? f_decode($_SESSION['mRef']) : 0;
            $manager->managerStatus = (!empty($managerStatus)) ? $managerStatus : 0;
            $actionText = 'Adicionado/a';
            break;
        case "upd":
            $manager = (new SysManagers())->findById(intval($id));
            $manager->updated_by = ($_SESSION['mRef']) ? f_decode($_SESSION['mRef']) : 0;
            $manager->managerStatus = (!empty($managerStatus)) ? $managerStatus : 0;
            $actionText = 'Atualizado/a';
            break;
        case "exc":
            $manager = (new SysManagers())->findById(intval($id));
            $manager->deleted_by = ($_SESSION['mRef']) ? f_decode($_SESSION['mRef']) : 0;
            $manager->deleted_at = f_datetime();
            $manager->managerStatus = 0;
            $actionText = 'Excluído/a';
            break;
    } // end switch

    // LOG
    $log = new SysLogs();
    $log->logAction = $action;
    $log->logDateTime = date('Y-m-d H:i:s');
    $log->managerUUID = f_decode($_SESSION['mUUID']);
    $log->logIP = f_ip();
    $log->logPage = "managers.sbm";
    $log->logData = json_encode($_POST);
    $log->created_by = f_decode($_SESSION['mID']);
    $log->logUUID = Uuid::uuid4();

    // echo '<pre>'.json_encode($_POST).'</pre>'.BR;
    
    foreach ($_POST as $field => $value) {
        $manager->{$field} = ($field !== "") ? trim($value) : null;
    }

    //echo '<pre>'.var_dump($manager->data()).'</pre>'.BR;exit;

    if (!$manager->save()) {
        $_SESSION["messages_form"]["tp"] = 'error';
        $_SESSION["messages_form"]["text"] = '<b>'. $pageTitle.'</b> não foi ' . $actionText . ', ocorreu um erro !' . $manager->fail()->getMessage();
        $log->logActionResult = 'Fail!';
        $log->save(); // save log
        if ($manager->fail()) {
            # echo 'erro !'.BR;
            $error = $manager->fail()->getMessage();
            echo $error.BR;
            f_dump($manager->data());
            $_SESSION['error']["page"] = "_managers.sbm";
            $_SESSION['error']["data"] = $error;
            

            die();
        }
    } else {
        $_SESSION["messages_form"]["tp"] = 'success';
        $_SESSION["messages_form"]["text"] = '<b>'. $pageTitle.'</b> ' . $actionText . ' com SUCESSO!';
        $log->logActionResult = 'Success!';
    }
    $log->save(); // save log
    
    # echo '<pre>'.json_encode($_SESSION).'</pre>'; exit;
    echo f_goto($goTo);

} // end if
?>