<?php
@session_start();
// echo '<pre>'.json_encode($_SESSION).'</pre>'; exit;
require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../src/Parameters.php';
require_once __DIR__. '/../src/Functions.php';
require_once __DIR__. '/../src/Tools/Translator.php';
include_once __DIR__. "/__session_verify.php";
ini_set("display_errors", 3);
//error_reporting(E_ALL);

use Ramsey\Uuid\Uuid;
use Src\Models\SysLogs;
use Src\Models\Videos;
use Src\Tools\UploadFile;

@define('PAGE_NAME', 'VIDEOS');
@define('NEXT_PAGE', '_videos.lst');
@define('ERROR_PAGE', '_videos.frm?ref='.f_encode($_POST['videoID']));

@define('UPLOAD_DIR', '../'.CONCIERGE_VIDEOS_FOLDER);

if ($_POST["action"]) {

    $_POST["shipCode"] = shipCode;
    $_POST["operCode"] = operCode;
    
    foreach ($_POST as $field => $value) {
        ${$field} = ($field !== "") ? trim($value) : null;
    }

    unset($_POST["action"]);
    
    $goTo = NEXT_PAGE;
    $goToError = ERROR_PAGE;

    $id = ($videoID) ? $videoID : null;
    switch ($action) {
        case "ins":
            $video = new Videos();
            $video->created_by = ($_SESSION['mRef']) ? f_decode($_SESSION['mRef']) : 0;
            $video->videoStatus = (!empty($videoStatus)) ? $videoStatus : 0;
            $actionText = 'Created';
            break;

        case "upd":
            $video = (new Videos())->findById(intval($id));
            $video->updated_by = ($_SESSION['mRef']) ? f_decode($_SESSION['mRef']) : 0;
            $video->videoStatus = (!empty($videoStatus)) ? $videoStatus : 0;
            $actionText = 'Updated';
            break;

        case "exc":
            $video = (new Videos())->findById(intval($id));
            @unlink(UPLOAD_DIR . $video->videoFile);
            $video->destroy();
            $actionText = 'Deleted';
            break;

    }

    foreach ($_POST as $field => $value) {
        $video->{$field} = ($field !== "") ? trim($value) : null;
    }

    // Verifique se um arquivo foi carregado e manipule-o
    if ($_FILES["videoFileNew"]["name"]) {
        $fileName = $_FILES["videoFileNew"]["name"];
        $fileSize = $_FILES["videoFileNew"]["size"];
        
        $ext = f_lower(f_fileextension($fileName));

        // Use UUID como o novo nome do arquivo
        $newFileName =  $videoUUID;
        $upload = new UploadFile($_FILES["videoFileNew"], UPLOAD_DIR, $newFileName);
        
        if(file_exists(UPLOAD_DIR . $newFileName.$ext)){
            
            $video->videoFileOriginal   = $fileName; // Save the original file name
            $video->videoFileSize       = $fileSize; // Save the file size
            $video->videoFile           = $videoUUID.$ext; // Save the new file name
            
            // obtem as dimensos do video
            $video->videoFileDimensions = f_getVideoDimensions($newFileName.$ext);
            
        }else{

            $_SESSION[CONTAINER_NAME."_messages_form"]["tp"] = 'error';
            $_SESSION[CONTAINER_NAME."_messages_form"]["text"] = '<b>' . PAGE_NAME . '</b> not ' . $actionText . ', an error has occurred! ';
            echo f_goto($goToError);
        }

    } // end if file uploaded

    #f_dump($video->data());

    if (!$video->save()) {
        echo 'não salvou'.BR;
        $_SESSION[CONTAINER_NAME."_messages_form"]["tp"] = 'error';
        $_SESSION[CONTAINER_NAME."_messages_form"]["text"] = '<b>' . PAGE_NAME . '</b> not ' . $actionText . ', an error has occurred! ' . $video->fail()->getMessage();
        
        if ($video->fail()) {
            echo 'deu fail !'.BR;
            $error = $video->fail()->getMessage();
            #f_dump($video->data());
            $_SESSION['error']["data"] = $error;
        
        }
        echo f_goto($goToError);
        die();

    }

    $_SESSION[CONTAINER_NAME."_messages_form"]["tp"] = 'success';
    $_SESSION[CONTAINER_NAME."_messages_form"]["text"] = '<b>' . PAGE_NAME . '</b> ' . $actionText . ' successfully!';
    
    echo f_goto($goTo);
    
} // end if ($_POST["action"]

?>
