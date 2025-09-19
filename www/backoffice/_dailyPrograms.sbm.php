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
use Src\Models\DailyPrograms;
use Src\Tools\UploadFile;

@define('PAGE_NAME', 'DAILY PROGRAM');
@define('NEXT_PAGE', '_dailyPrograms.lst');
@define('UPLOAD_DIR', '../'.CONCIERGE_DP_IMAGE_FOLDER);

#f_dump($_POST);
#f_dump($_FILES);
#exit;

if ($_POST["action"]) {
    
    $_POST["shipCode"] = shipCode;
    $_POST["operCode"] = operCode;
    $_POST["dpName"] = ($_POST["dpName"]) ? trim($_POST["dpName"]) : null;
    
    foreach ($_POST as $field => $value) {
        ${$field} = ($field !== "") ? trim($value) : null;
    }
    $id = ($_POST["action"] != "ins") ? $dpID : null;

    unset($_POST["action"]);
    $goTo = NEXT_PAGE;

    switch ($action) {
        case "ins":
            $dailyProgram = new DailyPrograms();
            $dailyProgram->created_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $dailyProgram->dpStatus = (!empty($dpStatus)) ? $dpStatus : 0;
            $actionText = 'Adicionado';
            break;
        case "upd":
            $dailyProgram = (new DailyPrograms())->findById(intval($id));
            $dailyProgram->updated_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $dailyProgram->dpStatus = (!empty($dpStatus)) ? $dpStatus : 0;
            $actionText = 'Atualizado';
            break;
        case "exc":
            $dailyProgram = (new DailyPrograms())->findById(intval($id));
            $dailyProgram->deleted_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $dailyProgram->deleted_at = f_datetime();
            $dailyProgram->dpStatus = 0;
            $actionText = 'Excluído';
            break;
    }

    #echo "<br>action: $action".BR;
    #f_dump($dailyProgram->Data()); exit;
    foreach ($_POST as $field => $value) {
        $dailyProgram->{$field} = ($field !== "") ? trim($value) : null;
    }
    

    if ($_FILES["dpFileNew"]["name"]) {
        $fileName = $_FILES["dpFileNew"]["name"];
        $fileSize = $_FILES["dpFileNew"]["size"];
        
        $ext = f_lower(f_fileextension($fileName));

        // Verifique se o arquivo é uma imagem PNG, JPG ou JPEG
        if (!in_array($ext, [".png", ".jpg", ".jpeg"])) {
            $_SESSION[CONTAINER_NAME . "_messages_form"]["tp"] = 'error';
            $_SESSION[CONTAINER_NAME . "_messages_form"]["text"] = "Error: The file must be PNG, JPG, JPEG or WebP!";
            echo f_goto($goToError);
            exit;
        }
        
        // Use UUID como o novo nome do arquivo
        $newFileName =  $dpUUID;
        #$newFileName = $dpUUID."{$ext}"; // new name of file with UUID registered

        #echo $newFileName . BR;
        
        $upload = new UploadFile($_FILES["dpFileNew"], UPLOAD_DIR, $newFileName);
        #echo $upload;
        
        #echo 'file'.BR;

        if(file_exists(UPLOAD_DIR .DS. $dailyProgram->dpFile)){
            // obtem as dimensos da imagem 
            list($width, $height) = getimagesize(UPLOAD_DIR .DS. $newFileName.$ext);
            $dailyProgram->dpFileDimensions = $width.' x '.$height;   
        } // 

        

        // Defina o novo nome do arquivo para o objeto para salvar no BD
        $dailyProgram->dpFileOriginal = $fileName; // Save the original file name
        $dailyProgram->dpFileSize = $fileSize;
        $dailyProgram->dpFile = $newFileName.$ext; // Save the new file name
    } // end Daily Program File

        // verifica se existe outro daily menu ativo e altera o status caso esteja ativo
        if ($action == "ins") {
            $dailyProgramActive = (new DailyPrograms())->find("shipCode=:sCode AND dpStatus=:st AND deleted_at IS NULL","sCode={$dailyProgram->shipCode}&st=1")->count();
            if ($dailyProgramActive>0) {
                $dailyProgram->dpStatus = 0;
            }
        }
        if ($action == "upd") {
            $dailyProgramActive = (new DailyPrograms())->find("shipCode=:sCode AND dpUUID!=:uuid AND dpStatus=:st AND deleted_at IS NULL","sCode={$dailyProgram->shipCode}&uuid={$dailyProgram->dpUUID}&st=1")->count();
            if ($dailyProgramActive>0) {
                $dailyProgram->dpStatus = 0;
            }
        }


    // LOG
    $log = new SysLogs();
    $log->logAction = $action;
    $log->logDateTime = date('Y-m-d H:i:s');
    $log->managerUUID = f_decode($_SESSION['mUUID']);
    $log->logIP = f_ip();
    $log->logPage = "dailyprograms.sbm";
    $log->logData = json_encode($_POST);
    $log->created_by = f_decode($_SESSION['mID']);
    $log->logUUID = Uuid::uuid4();
    
    #echo 'aqui<br>';
    #exit;

    if (!$dailyProgram->save()) {
        $_SESSION[CONTAINER_NAME."_messages_form"]["tp"] = 'error';
        $_SESSION[CONTAINER_NAME."_messages_form"]["text"] = '<b>' . PAGE_NAME . '</b> não foi ' . $actionText . ', ocorreu um erro! ' . $dailyProgram->fail()->getMessage();
        $log->logActionResult = 'Fail!';
        $log->save();
        if ($dailyProgram->fail()) {
            $error = $dailyProgram->fail()->getMessage();
            echo $error . "<br>";
            f_dump($dailyProgram->data());
            $_SESSION['error']["page"] = $log->logPage;
            $_SESSION['error']["data"] = $error;
            die();
        }
    } else {
        $_SESSION[CONTAINER_NAME."_messages_form"]["tp"] = 'success';
        $_SESSION[CONTAINER_NAME."_messages_form"]["text"] = '<b>' . PAGE_NAME . '</b> ' . $actionText . ' com SUCESSO!';
        $log->logActionResult = 'Success!';
    }

    $log->save();
    echo f_goto($goTo);
}

?>
