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
use Src\Models\SysNavs;

@define('PAGE_NAME',    'Items do Menu de Navegação');
@define('PREVIUS_PAGE', '_navs.frm');
@define('NEXT_PAGE',    '_navs.lst');

#f_dump($_POST);#exit;

if ($_POST["action"]) {

    $_POST["navGroupUUID"]      = ((strlen($_POST["navGroupUUID"])>0) || ($_POST["navGroupUUID"])!="0") ? $_POST["navGroupUUID"] : NULL;
    $_POST["navSubGroupUUID"] = (!empty($_POST["navSubGroupUUID"]) && $_POST["navSubGroupUUID"] !== "0") ? $_POST["navSubGroupUUID"] : null;
    
    foreach ($_POST as $field => $value) {
        ${$field} = ($field !== "") ? trim($value) : null;
    }

    unset($_POST["action"]);
    $goTo = NEXT_PAGE;
    $id = ($navID) ? $navID : null;

    switch ($action) {
        case "ins":
            $nav = new SysNavs();
            $nav->created_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $actionText = 'Created';
            break;
        case "upd":
            $nav = (new SysNavs())->findById(intval($id));
            $nav->updated_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $actionText = 'Updated';
            break;
        case "exc":
            $nav = (new SysNavs())->findById(intval($id));
            $nav->deleted_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $nav->deleted_at = f_datetime();
            $nav->navStatus = 0;
            $actionText = 'Deleted';
            break;
    }

    #echo "<br>action: $action".BR;
    #f_dump($nav->Data()); exit;
    
    foreach ($_POST as $field => $value) {
        if ($value === null) {
            $nav->{$field} = null;
        } elseif (is_string($value)) {
            $nav->{$field} = trim($value);
        } else {
            $nav->{$field} = $value;
        }
    } // end foreach
    
    // f_dump($nav->Data()); exit;

    // LOG
    $log = new SysLogs();
    $log->logAction = $action;
    $log->logDateTime = date('Y-m-d H:i:s');
    $log->managerUUID = f_decode($_SESSION[CONTAINER_NAME."_mUUID"]);
    $log->logIP = f_ip();
    $log->logPage = "navs.sbm";
    $log->logData = json_encode($_POST).json_encode($nav->data());
    $log->created_by = (f_decode($_SESSION[CONTAINER_NAME."_mID"])? f_decode($_SESSION[CONTAINER_NAME."_mID"]) : 0);
    $log->logUUID = Uuid::uuid4();
    


    if (!$nav->save()) {
        $_SESSION[CONTAINER_NAME."_messages_form"]["tp"] = 'error';
        $_SESSION[CONTAINER_NAME."_messages_form"]["text"] = '<b>' . PAGE_NAME . '</b> NOT ' . $actionText . ', an error occurred! ' . $nav->fail()->getMessage();
        $log->logActionResult = 'Fail!';
        if ($nav->fail()) {
            $error = $nav->fail()->getMessage();
            echo $error . "<br>";
            f_dump($nav->data());
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
        if ($nav->fail()) {
             $error = $nav->fail()->getMessage();
            echo $error . "<br>";
            f_dump($nav->data());
            die();
        }
        if (!$log->save()) { echo 'log save error !'.BR; echo $log->fail()->getMessage(); }
    }

    echo f_goto($goTo);
}

?>
