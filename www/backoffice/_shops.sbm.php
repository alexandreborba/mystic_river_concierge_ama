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
use Src\Models\Shops;
use Src\Tools\UploadFile;

@define('PAGE_NAME', 'SHOP IMAGE');
@define('NEXT_PAGE', '_shops.lst');
@define('UPLOAD_DIR', '../'.CONCIERGE_SHOPS_IMAGE_FOLDER);

#f_dump($_POST);
#f_dump($_FILES);
#exit;

if ($_POST["action"]) {
    
    $_POST["shipCode"] = shipCode;
    $_POST["operCode"] = operCode;
    $_POST["shopName"] = ($_POST["shopName"]) ? trim($_POST["shopName"]) : null;
    
    foreach ($_POST as $field => $value) {
        ${$field} = ($field !== "") ? trim($value) : null;
    }
    $id = ($_POST["action"] != "ins") ? $shopID : null;

    unset($_POST["action"]);
    $goTo = NEXT_PAGE;

    switch ($action) {
        case "ins":
            $shop = new Shops();
            $shop->created_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $shop->shopStatus = (!empty($shopStatus)) ? $shopStatus : 0;
            $actionText = 'Adicionado';
            break;
        case "upd":
            $shop = (new Shops())->findById(intval($id));
            $shop->updated_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $shop->shopStatus = (!empty($shopStatus)) ? $shopStatus : 0;
            $actionText = 'Atualizado';
            break;
        case "exc":
            $shop = (new Shops())->findById(intval($id));
            $shop->deleted_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $shop->deleted_at = f_datetime();
            $shop->shopStatus = 0;
            $actionText = 'Excluído';
            break;
    }

    #echo "<br>action: $action".BR;
    #f_dump($shop->Data()); exit;
    foreach ($_POST as $field => $value) {
        $shop->{$field} = ($field !== "") ? trim($value) : null;
    }
    
    if ($_FILES["shopFileNew"]["name"]) {
        $fileName = $_FILES["shopFileNew"]["name"];
        $fileSize = $_FILES["shopFileNew"]["size"];
        
        $ext = f_lower(f_fileextension($fileName));

        // Verifique se o arquivo é uma imagem PNG, JPG ou JPEG
        if (!in_array($ext, [".png", ".jpg", ".jpeg"])) {
            $_SESSION[CONTAINER_NAME . "_messages_form"]["tp"] = 'error';
            $_SESSION[CONTAINER_NAME . "_messages_form"]["text"] = "Error: The file must be PNG, JPG, JPEG or WebP!";
            echo f_goto($goToError);
            exit;
        }
        
        // Use UUID como o novo nome do arquivo
        $newFileName =  $shopUUID;
        #$newFileName = $shopUUID."{$ext}"; // new name of file with UUID registered

        #echo $newFileName . BR;
        
        $upload = new UploadFile($_FILES["shopFileNew"], UPLOAD_DIR, $newFileName);
        #echo $upload;
        
        #echo 'file'.BR;

        if(file_exists(UPLOAD_DIR .DS. $shop->shopFile)){
            // obtem as dimensos da imagem 
            list($width, $height) = getimagesize(UPLOAD_DIR .DS. $newFileName.$ext);
            $shop->shopFileDimensions = $width.' x '.$height;   
        } // 

        // Defina o novo nome do arquivo para o objeto para salvar no BD
        $shop->shopFileOriginal = $fileName; // Save the original file name
        $shop->shopFileSize = $fileSize;
        $shop->shopFile = $newFileName.$ext; // Save the new file name
    } // end Daily Program File

        // verifica se existe outro daily menu ativo e altera o status caso esteja ativo
        if ($action == "ins") {
            $shopActive = (new Shops())->find("shipCode=:sCode AND shopStatus=:st AND deleted_at IS NULL","sCode={$shop->shipCode}&st=1")->count();
            if ($shopActive>0) {
                $shop->shopStatus = 0;
            }
        }
        if ($action == "upd") {
            $shopActive = (new Shops())->find("shipCode=:sCode AND shopUUID!=:uuid AND shopStatus=:st AND deleted_at IS NULL","sCode={$shop->shipCode}&uuid={$shop->shopUUID}&st=1")->count();
            if ($shopActive>0) {
                $shop->shopStatus = 0;
            }
        }

    // LOG
    $log = new SysLogs();
    $log->logAction = $action;
    $log->logDateTime = date('Y-m-d H:i:s');
    $log->managerUUID = f_decode($_SESSION['mUUID']);
    $log->logIP = f_ip();
    $log->logPage = "shops.sbm";
    $log->logData = json_encode($_POST);
    $log->created_by = f_decode($_SESSION['mID']);
    $log->logUUID = Uuid::uuid4();
    
    #echo 'aqui<br>';
    #exit;

    if (!$shop->save()) {
        $_SESSION[CONTAINER_NAME."_messages_form"]["tp"] = 'error';
        $_SESSION[CONTAINER_NAME."_messages_form"]["text"] = '<b>' . PAGE_NAME . '</b> não foi ' . $actionText . ', ocorreu um erro! ' . $shop->fail()->getMessage();
        $log->logActionResult = 'Fail!';
        $log->save();
        if ($shop->fail()) {
            $error = $shop->fail()->getMessage();
            echo $error . "<br>";
            f_dump($shop->data());
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
