<?php
@session_start();
// echo '<pre>'.json_encode($_SESSION).'</pre>'; exit;
require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../src/Parameters.php';
require_once __DIR__. '/../src/Functions.php';
require_once __DIR__. '/../src/Tools/Translator.php';
include_once __DIR__. "/__session_verify.php";
ini_set("display_errors", 0);
# error_reporting(E_ALL);

use Ramsey\Uuid\Uuid;
use Src\Models\SysLogs;
use Src\Models\SysNavGroups;

@define('PAGE_NAME',    'Grupo do Menu de Navegação');
@define('PREVIUS_PAGE', '_navGroups.frm');
@define('NEXT_PAGE',    '_navGroups.lst');

#f_dump($_POST);#exit;

if ($_POST["action"]) {
    
    foreach ($_POST as $field => $value) {
        ${$field} = ($field !== "") ? trim($value) : null;
    }

    unset($_POST["action"]);
    $goTo = NEXT_PAGE;
    $id = ($navGroupID) ? $navGroupID : null;

    switch ($action) {
        case "ins":
            $navGroup = new SysNavGroups();
            $navGroup->created_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $actionText = 'Created';
            break;
        case "upd":
            $navGroup = (new SysNavGroups())->findById(intval($id));
            $navGroup->updated_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $actionText = 'Updated';
            break;
        case "exc":
            $navGroup = (new SysNavGroups())->findById(intval($id));
            $navGroup->deleted_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $navGroup->deleted_at = f_datetime();
            $navGroup->navGroupStatus = 0;
            $actionText = 'Deleted';
            break;
    }

    #echo "<br>action: $action".BR;
    #f_dump($navGroup->Data()); exit;
    
    foreach ($_POST as $field => $value) {
        if ($value === null) {
            $navGroup->{$field} = null;
        } elseif (is_string($value)) {
            $navGroup->{$field} = trim($value);
        } else {
            $navGroup->{$field} = $value;
        }
    } // end foreach
    
    #f_dump($navGroup->Data()); exit;

    // LOG
    $log = new SysLogs();
    $log->logAction = $action;
    $log->logDateTime = date('Y-m-d H:i:s');
    $log->managerUUID = f_decode($_SESSION[CONTAINER_NAME."_mUUID"]);
    $log->logIP = f_ip();
    $log->logPage = "navGroups.sbm";
    $log->logData = json_encode($_POST).json_encode($navGroup->data());
    $log->created_by = (f_decode($_SESSION[CONTAINER_NAME."_mID"])? f_decode($_SESSION[CONTAINER_NAME."_mID"]) : 0);
    $log->logUUID = Uuid::uuid4();
    


    if (!$navGroup->save()) {
        $_SESSION[CONTAINER_NAME."_messages_form"]["tp"] = 'error';
        $_SESSION[CONTAINER_NAME."_messages_form"]["text"] = '<b>' . PAGE_NAME . '</b> NOT ' . $actionText . ', an error occurred! ' . $navGroup->fail()->getMessage();
        $log->logActionResult = 'Fail!';
        if ($navGroup->fail()) {
            $error = $navGroup->fail()->getMessage();
            echo $error . "<br>";
            f_dump($navGroup->data());
            $_SESSION['error']["page"] = $log->logPage;
            $_SESSION['error']["data"] = $error;
            $log->logDataError = $error;
            $log->save();
            if (!$log->save()) { echo 'log save error !'.BR; echo $log->fail()->getMessage(); }
            die();
        }
    } else {
        $_SESSION[CONTAINER_NAME."_messages_form"]["tp"] = 'success';
        $_SESSION[CONTAINER_NAME."_messages_form"]["text"] = '<b>' . PAGE_NAME . '</b> ' . $actionText . ' SUCCESSFULLY!';
        $log->logActionResult = 'Success!';
        if ($navGroup->fail()) {
             $error = $navGroup->fail()->getMessage();
            echo $error . "<br>";
            f_dump($navGroup->data());
            die();
        }
        if (!$log->save()) { echo 'log save error !'.BR; echo $log->fail()->getMessage(); }
    }

    echo f_goto($goTo);
}

?>
