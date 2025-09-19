<?php
@session_start();
// echo '<pre>'.json_encode($_SESSION).'</pre>'; exit;
require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../src/Parameters.php';
require_once __DIR__. '/../src/Functions.php';
require_once __DIR__. '/../src/Tools/Translator.php';
include_once __DIR__. "/__session_verify.php";
ini_set("display_errors", 0);
#error_reporting(E_ALL);

use Ramsey\Uuid\Uuid;
use Src\Models\SysLogs;
use Src\Models\SysNavSubGroups;

@define('PAGE_NAME',    'SubGrupo do Menu de Navegação');
@define('PREVIUS_PAGE', '_navSubGroups.frm');
@define('NEXT_PAGE',    '_navSubGroups.lst');

#f_dump($_POST);#exit;

if ($_POST["action"]) {
    
    foreach ($_POST as $field => $value) {
        ${$field} = ($field !== "") ? trim($value) : null;
    }

    unset($_POST["action"]);
    $goTo = NEXT_PAGE;
    $id = ($navSubGroupID) ? $navSubGroupID : null;

    switch ($action) {
        case "ins":
            $navSubGroup = new SysNavSubGroups();
            $navSubGroup->created_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $actionText = 'Created';
            break;
        case "upd":
            $navSubGroup = (new SysNavSubGroups())->findById(intval($id));
            $navSubGroup->updated_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $actionText = 'Updated';
            break;
        case "exc":
            $navSubGroup = (new SysNavSubGroups())->findById(intval($id));
            $navSubGroup->deleted_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $navSubGroup->deleted_at = f_datetime();
            $navSubGroup->navSubGroupStatus = 0;
            $actionText = 'Deleted';
            break;
    }

    #echo "<br>action: $action".BR;
    #f_dump($navSubGroup->Data()); exit;
    
    foreach ($_POST as $field => $value) {
        if ($value === null) {
            $navSubGroup->{$field} = null;
        } elseif (is_string($value)) {
            $navSubGroup->{$field} = trim($value);
        } else {
            $navSubGroup->{$field} = $value;
        }
    } // end foreach
    
    #f_dump($navSubGroup->Data()); exit;

    // LOG
    $log = new SysLogs();
    $log->logAction = $action;
    $log->logDateTime = date('Y-m-d H:i:s');
    $log->managerUUID = f_decode($_SESSION[CONTAINER_NAME."_mUUID"]);
    $log->logIP = f_ip();
    $log->logPage = "navSubGroups.sbm";
    $log->logData = json_encode($_POST).json_encode($navSubGroup->data());
    $log->created_by = (f_decode($_SESSION[CONTAINER_NAME."_mID"])? f_decode($_SESSION[CONTAINER_NAME."_mID"]) : 0);
    $log->logUUID = Uuid::uuid4();
    


    if (!$navSubGroup->save()) {
        $_SESSION[CONTAINER_NAME."_messages_form"]["tp"] = 'error';
        $_SESSION[CONTAINER_NAME."_messages_form"]["text"] = '<b>' . PAGE_NAME . '</b> NOT ' . $actionText . ', an error occurred! ' . $navSubGroup->fail()->getMessage();
        $log->logActionResult = 'Fail!';
        if ($navSubGroup->fail()) {
            $error = $navSubGroup->fail()->getMessage();
            echo $error . "<br>";
            f_dump($navSubGroup->data());
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
        if ($navSubGroup->fail()) {
             $error = $navSubGroup->fail()->getMessage();
            echo $error . "<br>";
            f_dump($navSubGroup->data());
            die();
        }
        if (!$log->save()) { echo 'log save error !'.BR; echo $log->fail()->getMessage(); }
    }

    echo f_goto($goTo);
}

?>
