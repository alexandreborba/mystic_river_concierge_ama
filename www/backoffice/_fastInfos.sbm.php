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
use Src\Models\FastInfos;
use Src\Tools\UploadFile;

@define('PAGE_NAME', 'FAST INFO - QRCODE');
@define('NEXT_PAGE', '_fastInfos.lst');
@define('ERROR_PAGE', '_fastInfos.frm?ref='.f_encode($_POST['dpID']));
@define('UPLOAD_DIR', '../'.CONCIERGE_FINFOS_IMAGE_FOLDER);

#f_dump($_POST);
#f_dump($_FILES);
#exit;

if ($_POST["action"]) {

    $_POST["shipCode"] = shipCode;
    $_POST["operCode"] = operCode;
    
    foreach ($_POST as $field => $value) {
        ${$field} = ($field !== "") ? trim($value) : null;
    }

    unset($_POST["action"]);
    $goTo = NEXT_PAGE;
    $goToError = ERROR_PAGE;
    $id = ($fastInfoID) ? $fastInfoID : null;

    switch ($action) {
        case "ins":
            $fastInfo = new FastInfos();
            $fastInfo->created_by = ($_SESSION['mRef']) ? f_decode($_SESSION['mRef']) : 0;
            $fastInfo->fastInfoStatus = (!empty($fastInfoStatus)) ? $fastInfoStatus : 0;
            $actionText = 'Created';
            break;
        case "upd":
            $fastInfo = (new FastInfos())->findById(intval($id));
            $fastInfo->updated_by = ($_SESSION['mRef']) ? f_decode($_SESSION['mRef']) : 0;
            $fastInfo->fastInfoStatus = (!empty($fastInfoStatus)) ? $fastInfoStatus : 0;
            $actionText = 'Updated';
            break;
        case "exc":
            $fastInfo = (new FastInfos())->findById(intval($id));
            @unlink(UPLOAD_DIR . $fastInfo->fastInfoFile);
            $fastInfo->destroy();
            $actionText = 'Deleted';
            break;
    }


    foreach ($_POST as $field => $value) {
        $fastInfo->{$field} = ($field !== "") ? trim($value) : null;
    }

    #echo "<br>action: $action".BR;
    #f_dump($fastInfo->Data()); exit;

    // Verifique se um arquivo foi carregado e manipule-o
    if ($_FILES["fastInfoFileNew"]["name"]) {
        $fileName = $_FILES["fastInfoFileNew"]["name"];
        $fileSize = $_FILES["fastInfoFileNew"]["size"];
        
        $ext = f_lower(f_fileextension($fileName));

        // Verifique se o arquivo é uma imagem PNG, JPG ou JPEG
        if (!in_array($ext, [".png", ".jpg", ".jpeg"])) {
            $_SESSION[CONTAINER_NAME . "_messages_form"]["tp"] = 'error';
            $_SESSION[CONTAINER_NAME . "_messages_form"]["text"] = "Error: The file must be PNG, JPG, JPEG or WebP!";
            echo f_goto($goToError);
            exit;
        }
       
        // Use UUID como o novo nome do arquivo
        $newFileName =  $fastInfoUUID;
        $upload = new UploadFile($_FILES["fastInfoFileNew"], UPLOAD_DIR, $newFileName);
        if(file_exists(UPLOAD_DIR . $fastInfo->fastInfoFile)){
            // obtem as dimensos da imagem 
            list($width, $height) = getimagesize(UPLOAD_DIR . $newFileName.$ext);
            $fastInfo->fastInfoFileDimensions = $width.' x '.$height;   
        }

        // Defina o novo nome do arquivo para o objeto para salvar no BD
        $fastInfo->fastInfoFileOriginal = $fileName; // Save the original file name
        $fastInfo->fastInfoFileSize = $fileSize;

        $fastInfo->fastInfoFile = $fastInfoUUID.$ext; // Save the new file name
    }


    // LOG
    $log = new SysLogs();
    $log->logAction = $action;
    $log->logDateTime = date('Y-m-d H:i:s');
    $log->managerUUID = f_decode($_SESSION[CONTAINER_NAME."_mUUID"]);
    $log->logIP = f_ip();
    $log->logPage = "FastInfos.sbm";
    $log->logData = json_encode($_POST);
    $log->logDataFile = (count($_FILES)>0) ? json_encode($_FILES) : null ;
    $log->created_by = f_decode($_SESSION[CONTAINER_NAME."_mID"]);
    $log->logUUID = Uuid::uuid4();
    


    if (!$fastInfo->save()) {
        $_SESSION[CONTAINER_NAME."_messages_form"]["tp"] = 'error';
        $_SESSION[CONTAINER_NAME."_messages_form"]["text"] = '<b>' . PAGE_NAME . '</b> not ' . $actionText . ', an error has occurred! ' . $fastInfo->fail()->getMessage();
        $log->logActionResult = 'Fail!';
        if ($fastInfo->fail()) {
            $error = $fastInfo->fail()->getMessage();
            echo $error . "<br>";
            f_dump($fastInfo->data());
            $_SESSION['error']["page"] = $log->logPage;
            $_SESSION['error']["data"] = $error;
            $log->logDataError = $error;
            $log->save();
            die();
        }
    } else {
        $_SESSION[CONTAINER_NAME."_messages_form"]["tp"] = 'success';
        $_SESSION[CONTAINER_NAME."_messages_form"]["text"] = '<b>' . PAGE_NAME . '</b> ' . $actionText . ' successfully!';
        $log->logActionResult = 'Success!';
        $log->save();
    }

    echo f_goto($goTo);
}

?>
