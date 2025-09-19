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
use Src\Models\Spas;
use Src\Tools\UploadFile;

@define('PAGE_NAME', 'SPA IMAGE');
@define('NEXT_PAGE', '_spas.lst');
@define('UPLOAD_DIR', '../'.CONCIERGE_SPAS_IMAGE_FOLDER);

#f_dump($_POST);
#f_dump($_FILES);
#exit;

if ($_POST["action"]) {
    
    $_POST["shipCode"] = shipCode;
    $_POST["operCode"] = operCode;
    $_POST["spaName"] = ($_POST["spaName"]) ? trim($_POST["spaName"]) : null;
    
    foreach ($_POST as $field => $value) {
        ${$field} = ($field !== "") ? trim($value) : null;
    }
    $id = ($_POST["action"] != "ins") ? $spaID : null;

    unset($_POST["action"]);
    $goTo = NEXT_PAGE;

    switch ($action) {
        case "ins":
            $spa = new Spas();
            $spa->created_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $spa->spaStatus = (!empty($spaStatus)) ? $spaStatus : 0;
            $actionText = 'Adicionado';
            break;
        case "upd":
            $spa = (new Spas())->findById(intval($id));
            $spa->updated_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $spa->spaStatus = (!empty($spaStatus)) ? $spaStatus : 0;
            $actionText = 'Atualizado';
            break;
        case "exc":
            $spa = (new Spas())->findById(intval($id));
            $spa->deleted_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $spa->deleted_at = f_datetime();
            $spa->spaStatus = 0;
            $actionText = 'Excluído';
            break;
    }

    #echo "<br>action: $action".BR;
    #f_dump($spa->Data()); exit;
    foreach ($_POST as $field => $value) {
        $spa->{$field} = ($field !== "") ? trim($value) : null;
    }
    
    if ($_FILES["spaFileNew"]["name"]) {
        $fileName = $_FILES["spaFileNew"]["name"];
        $fileSize = $_FILES["spaFileNew"]["size"];
        
        $ext = f_lower(f_fileextension($fileName));

        // Verifique se o arquivo é uma imagem PNG, JPG ou JPEG
        if (!in_array($ext, [".png", ".jpg", ".jpeg"])) {
            $_SESSION[CONTAINER_NAME . "_messages_form"]["tp"] = 'error';
            $_SESSION[CONTAINER_NAME . "_messages_form"]["text"] = "Error: The file must be PNG, JPG, JPEG or WebP!";
            echo f_goto($goToError);
            exit;
        }
        
        // Use UUID como o novo nome do arquivo
        $newFileName =  $spaUUID;
        #$newFileName = $spaUUID."{$ext}"; // new name of file with UUID registered

        #echo $newFileName . BR;
        
        $upload = new UploadFile($_FILES["spaFileNew"], UPLOAD_DIR, $newFileName);
        #echo $upload;
        
        #echo 'file'.BR;

        if(file_exists(UPLOAD_DIR .DS. $spa->spaFile)){
            // obtem as dimensos da imagem 
            list($width, $height) = getimagesize(UPLOAD_DIR .DS. $newFileName.$ext);
            $spa->spaFileDimensions = $width.' x '.$height;   
        } // 

        // Defina o novo nome do arquivo para o objeto para salvar no BD
        $spa->spaFileOriginal = $fileName; // Save the original file name
        $spa->spaFileSize = $fileSize;
        $spa->spaFile = $newFileName.$ext; // Save the new file name
    } // end Daily Program File

        // verifica se existe outro daily menu ativo e altera o status caso esteja ativo
        if ($action == "ins") {
            $spaActive = (new Spas())->find("shipCode=:sCode AND spaStatus=:st AND deleted_at IS NULL","sCode={$shop->shipCode}&st=1")->count();
            if ($spaActive>0) {
                $spa->spaStatus = 0;
            }
        }
        if ($action == "upd") {
            $spaActive = (new Spas())->find("shipCode=:sCode AND spaUUID!=:uuid AND spaStatus=:st AND deleted_at IS NULL","sCode={$shop->shipCode}&uuid={$spa->spaUUID}&st=1")->count();
            if ($spaActive>0) {
                $spa->spaStatus = 0;
            }
        }

    // LOG
    $log = new SysLogs();
    $log->logAction = $action;
    $log->logDateTime = date('Y-m-d H:i:s');
    $log->managerUUID = f_decode($_SESSION['mUUID']);
    $log->logIP = f_ip();
    $log->logPage = "spas.sbm";
    $log->logData = json_encode($_POST);
    $log->created_by = f_decode($_SESSION['mID']);
    $log->logUUID = Uuid::uuid4();
    
    #echo 'aqui<br>';
    #exit;

    if (!$spa->save()) {
        $_SESSION[CONTAINER_NAME."_messages_form"]["tp"] = 'error';
        $_SESSION[CONTAINER_NAME."_messages_form"]["text"] = '<b>' . PAGE_NAME . '</b> não foi ' . $actionText . ', ocorreu um erro! ' . $spa->fail()->getMessage();
        $log->logActionResult = 'Fail!';
        $log->save();
        if ($spa->fail()) {
            $error = $spa->fail()->getMessage();
            echo $error . "<br>";
            f_dump($spa->data());
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
