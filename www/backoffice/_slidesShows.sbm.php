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
use Src\Models\SlidesShows;
use Src\Tools\UploadFile;


@define('PAGE_NAME', 'SLIDES SHOWS');
@define('NEXT_PAGE', '_slidesShows.lst');
@define('ERROR_PAGE', '__slidesShows.frm?ref='.f_encode($_POST['slideID']));
@define('UPLOAD_DIR', '../'.CONCIERGE_SSHOW_IMAGE_FOLDER);

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
    $id = ($slideID) ? $slideID : null;

    switch ($action) {
        case "ins":
            $slide = new SlidesShows();
            $slide->created_by = ($_SESSION['mRef']) ? f_decode($_SESSION['mRef']) : 0;
            $slide->slideStatus = (!empty($slideStatus)) ? $slideStatus : 0;
            $actionText = 'Created';
            break;
        case "upd":
            $slide = (new SlidesShows())->findById(intval($id));
            $slide->updated_by = ($_SESSION['mRef']) ? f_decode($_SESSION['mRef']) : 0;
            $slide->slideStatus = (!empty($slideStatus)) ? $slideStatus : 0;
            $actionText = 'Updated';
            break;
        case "exc":
            $slide = (new SlidesShows())->findById(intval($id));
            @unlink(UPLOAD_DIR . $slide->slideFile);
            $slide->destroy();
            $actionText = 'Deleted';
            break;
    }


    foreach ($_POST as $field => $value) {
        $slide->{$field} = ($field !== "") ? trim($value) : null;
    }

    #echo "<br>action: $action".BR;
    #f_dump($slide->Data()); exit;

    // Verifique se um arquivo foi carregado e manipule-o
    if ($_FILES["slideFileNew"]["name"]) {
        $fileName = $_FILES["slideFileNew"]["name"];
        $fileSize = $_FILES["slideFileNew"]["size"];
        // Verifique se há um arquivo existente e exclua-o
        if ($slide->slideFile) {
            if (file_exists(UPLOAD_DIR . $slide->slideFile)) {
                @unlink(UPLOAD_DIR . $slide->slideFile);
                $slide->slideFile = null;
                $log->logData .= "{image ".$slide->slideFile." Deleted! }";
            }
        }

        $ext = f_lower(f_fileextension($fileName));

        // Verifique se o arquivo é uma imagem PNG, JPG ou JPEG
        if (!in_array($ext, [".png", ".jpg", ".jpeg"])) {
            $_SESSION[CONTAINER_NAME . "_messages_form"]["tp"] = 'error';
            $_SESSION[CONTAINER_NAME . "_messages_form"]["text"] = "Error: The file must be PNG, JPG, JPEG or WebP!";
            echo f_goto($goToError);
            exit;
        }
       
        // Use UUID como o novo nome do arquivo
        $newFileName =  $slideUUID;
        $upload = new UploadFile($_FILES["slideFileNew"], UPLOAD_DIR, $newFileName);
        if(file_exists(UPLOAD_DIR . $slide->slideFile)){
            // obtem as dimensos da imagem 
            list($width, $height) = getimagesize(UPLOAD_DIR . $newFileName.$ext);

            $slide->slideFileDimensions = $width.' x '.$height;   
            $slide->slideFileOriginal = $fileName; // Save the original file name
            $slide->slideFile     = $newFileName.$ext; // Save the new file name
            $slide->slideFileSize = $fileSize; // Save the new file name
        }


        // Defina o novo nome do arquivo para o objeto para salvar no BD
        
    }


    // LOG
    $log = new SysLogs();
    $log->logAction = $action;
    $log->logDateTime = date('Y-m-d H:i:s');
    $log->managerUUID = f_decode($_SESSION[CONTAINER_NAME."_mUUID"]);
    $log->logIP = f_ip();
    $log->logPage = "SlidesShows.sbm";
    $log->logData = json_encode($_POST);
    $log->logDataFile = json_encode($_FILES);
    $log->created_by = f_decode($_SESSION[CONTAINER_NAME."_mID"]);
    $log->logUUID = Uuid::uuid4();
    


    if (!$slide->save()) {
        $_SESSION[CONTAINER_NAME."_messages_form"]["tp"] = 'error';
        $_SESSION[CONTAINER_NAME."_messages_form"]["text"] = '<b>' . PAGE_NAME . '</b> not ' . $actionText . ', an error has occurred! ' . $slide->fail()->getMessage();
        $log->logActionResult = 'Fail!';
        
        if ($slide->fail()) {
            $error = $slide->fail()->getMessage();
            echo $error . "<br>";
            f_dump($slide->data());
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
    }

    $log->save();
    echo f_goto($goTo);
}

?>
