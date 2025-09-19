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
use Src\Models\DailyMenus;
use Src\Tools\UploadFile;

@define('PAGE_NAME', 'DAILY MENU');
@define('NEXT_PAGE', '_dailyMenus.lst');
@define('UPLOAD_DIR', '../'.CONCIERGE_DM_IMAGE_FOLDER);

#f_dump($_POST);
#f_dump($_FILES);
#exit;

if ($_POST["action"]) {
    
    $_POST["shipCode"] = shipCode;
    $_POST["operCode"] = operCode;
    $_POST["dmName"] = ($_POST["dmName"]) ? trim($_POST["dmName"]) : null;
    
    foreach ($_POST as $field => $value) {
        ${$field} = ($field !== "") ? trim($value) : null;
    }
    $id = ($_POST["action"] != "ins") ? $dmID : null;

    unset($_POST["action"]);
    $goTo = NEXT_PAGE;

    switch ($action) {
        case "ins":
            $dailyMenu = new DailyMenus();
            $dailyMenu->created_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $dailyMenu->dmStatus = (!empty($dmStatus)) ? $dmStatus : 0;
            $actionText = 'Adicionado';
            break;
        case "upd":
            $dailyMenu = (new DailyMenus())->findById(intval($id));
            $dailyMenu->updated_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $dailyMenu->dmStatus = (!empty($dmStatus)) ? $dmStatus : 0;
            $actionText = 'Atualizado';
            break;
        case "exc":
            $dailyMenu = (new DailyMenus())->findById(intval($id));
            $dailyMenu->deleted_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $dailyMenu->deleted_at = f_datetime();
            $dailyMenu->dmStatus = 0;
            $actionText = 'Excluído';
            break;
    }

    #echo "<br>action: $action".BR;
    #f_dump($dailyMenu->Data()); exit;
    foreach ($_POST as $field => $value) {
        $dailyMenu->{$field} = ($field !== "") ? trim($value) : null;
    }
    

    if ($_FILES["dmFileNew"]["name"]) {
        $fileName = $_FILES["dmFileNew"]["name"];
        $fileSize = $_FILES["dmFileNew"]["size"];
        
        $ext = f_lower(f_fileextension($fileName));

        // Verifique se o arquivo é uma imagem PNG, JPG ou JPEG
        if (!in_array($ext, [".png", ".jpg", ".jpeg"])) {
            $_SESSION[CONTAINER_NAME . "_messages_form"]["tp"] = 'error';
            $_SESSION[CONTAINER_NAME . "_messages_form"]["text"] = "Error: The file must be PNG, JPG, JPEG or WebP!";
            echo f_goto($goToError);
            exit;
        }
        
        // Use UUID como o novo nome do arquivo
        $newFileName =  $dmUUID;
        #$newFileName = $dmUUID."{$ext}"; // new name of file with UUID registered

        #echo $newFileName . BR;
        
        $upload = new UploadFile($_FILES["dmFileNew"], UPLOAD_DIR, $newFileName);
        #echo $upload;
        
        #echo 'file'.BR;

        if(file_exists(UPLOAD_DIR .DS. $dailyMenu->dmFile)){
            // obtem as dimensos da imagem 
            list($width, $height) = getimagesize(UPLOAD_DIR .DS. $newFileName.$ext);
            $dailyMenu->dmFileDimensions = $width.' x '.$height;   
        } // 

        

        // Defina o novo nome do arquivo para o objeto para salvar no BD
        $dailyMenu->dmFileOriginal = $fileName; // Save the original file name
        $dailyMenu->dmFileSize = $fileSize;
        $dailyMenu->dmFile = $newFileName.$ext; // Save the new file name
    } // end Daily Program File

    // verifica se existe outro daily menu ativo e altera o status caso esteja ativo
    if ($action == "ins") {
        $dailyMenuActive = (new DailyMenus())->find("shipCode=:sCode AND dmStatus=:st AND deleted_at IS NULL","sCode={$dailyProgram->shipCode}&st=1")->count();
        if ($dailyMenuActive>0) {
            $dailyMenu->dmStatus = 0;
        }
    }
    if ($action == "upd") {
        $dailyMenuActive = (new DailyMenus())->find("shipCode=:sCode AND dmUUID!=:uuid AND dmStatus=:st AND deleted_at IS NULL","sCode={$dailyProgram->shipCode}&uuid={$dailyMenu->dmUUID}&st=1")->count();
        if ($dailyMenuActive>0) {
            $dailyMenu->dmStatus = 0;
        }
    }

    // LOG
    $log = new SysLogs();
    $log->logAction = $action;
    $log->logDateTime = date('Y-m-d H:i:s');
    $log->managerUUID = f_decode($_SESSION['mUUID']);
    $log->logIP = f_ip();
    $log->logPage = "dailyMenus.sbm";
    $log->logData = json_encode($_POST);
    $log->created_by = f_decode($_SESSION['mID']);
    $log->logUUID = Uuid::uuid4();
    
   
    if (!$dailyMenu->save()) {
        $_SESSION[CONTAINER_NAME."_messages_form"]["tp"] = 'error';
        $_SESSION[CONTAINER_NAME."_messages_form"]["text"] = '<b>' . PAGE_NAME . '</b> não foi ' . $actionText . ', ocorreu um erro! ' . $dailyMenu->fail()->getMessage();
        $log->logActionResult = 'Fail!';
        $log->save();
        if ($dailyMenu->fail()) {
            $error = $dailyMenu->fail()->getMessage();
            echo $error . "<br>";
            f_dump($dailyMenu->data());
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
