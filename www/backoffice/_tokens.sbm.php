<?php
@session_start();
// echo '<pre>'.json_encode($_SESSION).'</pre>'; exit;
require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../src/Parameters.php';
require_once __DIR__. '/../src/Functions.php';
require_once __DIR__. '/../src/Tools/Translator.php';
include_once __DIR__. "/__session_verify.php";
ini_set("display_errors", 0);
//error_reporting(E_ALL);

use Ramsey\Uuid\Uuid;
use Src\Models\SysLogs;
use Src\Models\SysTokens;

@define('PAGE_NAME', 'TOKEN');
@define('NEXT_PAGE', '_tokens.lst');

#f_dump($_POST);
#exit;

if ($_POST["action"]) {

    $_POST["shipCode"] = shipCode;
    $_POST["operCode"] = operCode;
    
    foreach ($_POST as $field => $value) {
        ${$field} = ($field !== "") ? trim($value) : null;
    }

    unset($_POST["action"]);
    $goTo = NEXT_PAGE;
    $id = ($tokenID) ? $tokenID : null;

    switch ($action) {
        case "ins":
            $token = new SysTokens();
            $token->created_by = ($_SESSION['mRef']) ? f_decode($_SESSION['mRef']) : 0;
            $token->tokenStatus = (!empty($tokenStatus)) ? $tokenStatus : 0;
            $actionText = 'Created';
            break;
        case "upd":
            $token = (new SysTokens())->findById(intval($id));
            $token->updated_by = ($_SESSION['mRef']) ? f_decode($_SESSION['mRef']) : 0;
            $token->tokenStatus = (!empty($tokenStatus)) ? $tokenStatus : 0;
            $actionText = 'Updated';
            break;
        case "exc":
            $token = (new SysTokens())->findById(intval($id));
            $token->deleted_by = ($_SESSION['mRef']) ? f_decode($_SESSION['mRef']) : 0;
            $token->deleted_at = f_datetime();
            $token->tokenStatus = 0;
            $actionText = 'Deleted';
            break;
    }

    #echo "<br>action: $action".BR;
    #f_dump($token->Data()); exit;

    foreach ($_POST as $field => $value) {
        $token->{$field} = ($field !== "") ? trim($value) : null;
    }

    // LOG
    $log = new SysLogs();
    $log->logAction = $action;
    $log->logDateTime = date('Y-m-d H:i:s');
    $log->managerUUID = f_decode($_SESSION[CONTAINER_NAME."_mUUID"]);
    $log->logIP = f_ip();
    $log->logPage = "tokens.sbm";
    $log->logData = json_encode($_POST);
    $log->created_by = (f_decode($_SESSION[CONTAINER_NAME."_mID"])? f_decode($_SESSION[CONTAINER_NAME."_mID"]) : 0);
    $log->logUUID = Uuid::uuid4();
    


    if (!$token->save()) {
        $_SESSION[CONTAINER_NAME."_messages_form"]["tp"] = 'error';
        $_SESSION[CONTAINER_NAME."_messages_form"]["text"] = '<b>' . PAGE_NAME . '</b> NOT ' . $actionText . ', an error occurred! ' . $token->fail()->getMessage();
        $log->logActionResult = 'Fail!';
        if ($token->fail()) {
            $error = $token->fail()->getMessage();
            echo $error . "<br>";
            f_dump($token->data());
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
