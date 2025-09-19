<?php
@session_start();
require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../src/Parameters.php';
require_once __DIR__. '/../src/Functions.php';
require_once __DIR__. '/../src/Tools/Translator.php';
include_once __DIR__. "/__session_verify.php";
ini_set("display_errors", 0);
#error_reporting(E_ALL);

use Ramsey\Uuid\Uuid;
use Src\Models\SysLogs;
use Src\Models\SysLanguages;

@define('PAGE_NAME', 'LANGUAGE');
@define('NEXT_PAGE', '_languages.lst');

#f_dump($_POST);
#exit;

if ($_POST["action"]) {

    $_POST["langCode"] = f_lower(trim($_POST["langCode"]));
    $_POST["langName"] = f_caption(trim($_POST["langName"]));
    
    foreach ($_POST as $field => $value) {
        ${$field} = ($field !== "") ? trim($value) : null;
    }

    unset($_POST["action"]);
    $goTo = NEXT_PAGE;
    $id = ($langID) ? $langID : null;

    switch ($action) {
        case "ins":
            $lang = new SysLanguages();
            $lang->created_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $lang->langStatus = (!empty($langStatus)) ? $langStatus : 0;
            $actionText = 'Created';
            break;
        case "upd":
            $lang = (new SysLanguages())->findById(intval($id));
            $lang->updated_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $lang->langStatus = (!empty($langStatus)) ? $langStatus : 0;
            $actionText = 'Updated';
            break;
        case "exc":
            $lang = (new SysLanguages())->findById(intval($id));
            $lang->deleted_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $lang->deleted_at = f_datetime();
            $lang->langStatus = 0;
            $actionText = 'Deleted';
            break;
    }

    #echo "<br>action: $action".BR;
    #f_dump($lang->Data()); exit;

    foreach ($_POST as $field => $value) {
        $lang->{$field} = ($field !== "") ? trim($value) : null;
    }

    // LOG
    $log = new SysLogs();
    $log->logAction = $action;
    $log->logDateTime = date('Y-m-d H:i:s');
    $log->managerUUID = f_decode($_SESSION[CONTAINER_NAME."_mUUID"]);
    $log->logIP = f_ip();
    $log->logPage = "languages.sbm";
    $log->logData = json_encode($_POST);
    $log->created_by = (f_decode($_SESSION[CONTAINER_NAME."_mID"])? f_decode($_SESSION[CONTAINER_NAME."_mID"]) : 0);
    $log->logUUID = Uuid::uuid4();
    


    if (!$lang->save()) {
        $_SESSION[CONTAINER_NAME."_messages_form"]["tp"] = 'error';
        $_SESSION[CONTAINER_NAME."_messages_form"]["text"] = '<b>' . PAGE_NAME . '</b> NOT ' . $actionText . ', an error occurred! ' . $lang->fail()->getMessage();
        $log->logActionResult = 'Fail!';
        if ($lang->fail()) {
            $error = $lang->fail()->getMessage();
            echo $error . "<br>";
            f_dump($lang->data());
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
        if (!$log->save()) { echo 'log save error !'.BR; echo $log->fail()->getMessage(); }
    }

    echo f_goto($goTo);
}

?>
