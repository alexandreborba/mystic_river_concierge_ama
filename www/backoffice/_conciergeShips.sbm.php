<?php
@session_start();
// echo '<pre>'.json_encode($_SESSION).'</pre>'; exit;
require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../src/Parameters.php';
require_once __DIR__. '/../src/Functions.php';
require_once __DIR__. '/../src/Tools/Translator.php';
include_once __DIR__. "/__session_verify.php";
ini_set("display_errors", 0);
// error_reporting(E_ALL);

use Ramsey\Uuid\Uuid;
use Src\Models\SysLogs;
use Src\Models\ConciergeShips;
use Src\Tools\UploadFile;

@define('PAGE_NAME', 'CONFIG CONCIERGE');
@define('NEXT_PAGE', '_conciergeShips.lst');

@define('UPLOAD_DIR',               '../'.CONCIERGE_SHIP_IMAGE_FOLDER);
@define('NOCONTENT_CONCIERGE_DIR',  '../'.CONCIERGE_SHIP_CONCIERGE_NOCONTENT_FOLDER);
@define('NOCONTENT_RESTAURANT_DIR', '../'.CONCIERGE_SHIP_RESTAURANT_NOCONTENT_FOLDER);
@define('NOCONTENT_LOGO_DIR',       '../'.CONCIERGE_SHIP_LOGO_NOCONTENT_FOLDER);

//f_dump($_POST);
//f_dump($_FILES);


if ($_POST["action"]) {
    
    $_POST["shipCode"] = shipCode;
    $_POST["operCode"] = operCode;
    
    foreach ($_POST as $field => $value) {
        ${$field} = ($field !== "") ? trim($value) : null;
    }
    $id = ($_POST["action"] != "ins") ? $shipID : null;

    unset($_POST["action"]);
    $goTo = NEXT_PAGE;

    switch ($action) {
        case "ins":
            $ship = new ConciergeShips();
            $ship->created_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $ship->shipStatus = (!empty($shipStatus)) ? $shipStatus : 0;
            $actionText = 'Adicionado';
            break;
        case "upd":
            $ship = (new ConciergeShips())->findById(intval($id));
            $ship->updated_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $ship->shipStatus = (!empty($shipStatus)) ? $shipStatus : 0;
            $actionText = 'Atualizado';
            break;
        case "exc":
            $ship = (new ConciergeShips())->findById(intval($id));
            $ship->deleted_by = ($_SESSION[CONTAINER_NAME."_mRef"]) ? f_decode($_SESSION[CONTAINER_NAME."_mRef"]) : 0;
            $ship->deleted_at = f_datetime();
            $ship->shipStatus = 0;
            $actionText = 'Excluído';
            break;
    }

    #echo "<br>action: $action".BR;
    #f_dump($ship->Data()); exit;
    foreach ($_POST as $field => $value) {
        $ship->{$field} = ($field !== "") ? trim($value) : null;
    }
    

    if ($_FILES["shipFileLogoNew"]["name"]) {
        $fileName = $_FILES["shipFileLogoNew"]["name"];
        $fileSize = $_FILES["shipFileLogoNew"]["size"];
        
        $ext = f_lower(f_fileextension($fileName));

        // Verifique se o arquivo é uma imagem PNG, JPG ou JPEG
        if (!in_array($ext, [".png", ".jpg", ".jpeg"])) {
            $_SESSION[CONTAINER_NAME . "_messages_form"]["tp"] = 'error';
            $_SESSION[CONTAINER_NAME . "_messages_form"]["text"] = "Error: The file must be PNG, JPG, JPEG or WebP!";
            echo f_goto($goToError);
            exit;
        }
        
        // Use UUID como o novo nome do arquivo
        $newFileName =  $shipUUID.'_logo';
        #$newFileName = $dpUUID."{$ext}"; // new name of file with UUID registered

        $noContentFileName = shipCode;
        
        // 1) mova o upload para UPLOAD_DIR
        $upload = new UploadFile(
            $_FILES["shipFileLogoNew"],
            UPLOAD_DIR,
            $newFileName
        );

        // 2) copie o arquivo já movido para o outro diretório
        $origPath = $upload->getFullPath();               // ex: /var/www/html/nocontent/uuid_concierge_nocontent.png
        $targetPath = NOCONTENT_LOGO_DIR
                    . DS
                    . $noContentFileName
                    . $ext;                              // ex: /var/www/html/concierge_nocontent/no_content.png

        if (!copy($origPath, $targetPath)) {
            throw new \RuntimeException(
                "Não foi possível copiar “{$origPath}” para “{$targetPath}”."
            );
            exit;
        }
        #echo $upload;
        // agora você pode armazenar nos campos do seu $ship:
        $ship->shipFileLogo = $newFileName . $ext;
        
        #echo 'file'.BR;

        if(file_exists(UPLOAD_DIR .DS. $ship->shipFileLogo)){
            // obtem as dimensos da imagem 
            list($width, $height) = getimagesize(UPLOAD_DIR .DS. $newFileName.$ext);
            $ship->shipFileLogoDimensions = $width.' x '.$height; 
        } // 

        // Defina o novo nome do arquivo para o objeto para salvar no BD
        #$ship->shipFileOriginal = $fileName; // Save the original file name
        $ship->shipFileLogoSize = $fileSize;
        $ship->shipFileLogo = $newFileName.$ext; // Save the new file name
    } // end shipFileLogo


    if ($_FILES["shipFileImageNew"]["name"]) {
        $fileName = $_FILES["shipFileImageNew"]["name"];
        $fileSize = $_FILES["shipFileImageNew"]["size"];
        
        $ext = f_lower(f_fileextension($fileName));

        // Verifique se o arquivo é uma imagem PNG, JPG ou JPEG
        if (!in_array($ext, [".png", ".jpg", ".jpeg"])) {
            $_SESSION[CONTAINER_NAME . "_messages_form"]["tp"] = 'error';
            $_SESSION[CONTAINER_NAME . "_messages_form"]["text"] = "Error: The file must be PNG, JPG, JPEG or WebP!";
            echo f_goto($goToError);
            exit;
        }
        
        // Use UUID como o novo nome do arquivo
        $newFileName =  $shipUUID.'_image';
        #$newFileName = $dpUUID."{$ext}"; // new name of file with UUID registered

        #echo $newFileName . BR;
        
        $upload = new UploadFile($_FILES["shipFileImageNew"], UPLOAD_DIR, $newFileName);
        #echo $upload;
        
        #echo 'file'.BR;

        if(file_exists(UPLOAD_DIR .DS. $ship->shipFileImage)){
            // obtem as dimensos da imagem 
            list($width, $height) = getimagesize(UPLOAD_DIR .DS. $newFileName.$ext);
            $ship->shipFileImageDimensions = $width.' x '.$height;   
        } // 

        // Defina o novo nome do arquivo para o objeto para salvar no BD
        #$ship->shipFileOriginal = $fileName; // Save the original file name
        $ship->shipFileImageSize = $fileSize;
        $ship->shipFileImage = $newFileName.$ext; // Save the new file name
    } // end newFileName

    if ($_FILES["shipConciergeNoContentImageNew"]["name"]) {
        $fileName = $_FILES["shipConciergeNoContentImageNew"]["name"];
        $fileSize = $_FILES["shipConciergeNoContentImageNew"]["size"];
        
        $ext = f_lower(f_fileextension($fileName));

        // Verifique se o arquivo é uma imagem PNG, JPG ou JPEG
        if (!in_array($ext, [".png"])) {
            $_SESSION[CONTAINER_NAME . "_messages_form"]["tp"] = 'error';
            $_SESSION[CONTAINER_NAME . "_messages_form"]["text"] = "Error: The file must be PNG, JPG, JPEG or WebP!";
            echo f_goto($goToError);
            exit;
        }
        
        // Use UUID como o novo nome do arquivo
        $newFileName =  $shipUUID.'_concierge_nocontent';
        #$newFileName = $dpUUID."{$ext}"; // new name of file with UUID registered

        #echo $newFileName . BR;
        $noContentFileName = 'no_content';

        // 1) mova o upload para UPLOAD_DIR
        $upload = new UploadFile(
            $_FILES["shipConciergeNoContentImageNew"],
            UPLOAD_DIR,
            $newFileName
        );

        // 2) copie o arquivo já movido para o outro diretório
        $origPath = $upload->getFullPath();               // ex: /var/www/html/nocontent/uuid_concierge_nocontent.png
        $targetPath = NOCONTENT_CONCIERGE_DIR
                    . DS
                    . $noContentFileName
                    . $ext;                              // ex: /var/www/html/concierge_nocontent/no_content.png

        if (!copy($origPath, $targetPath)) {
            throw new \RuntimeException(
                "Não foi possível copiar “{$origPath}” para “{$targetPath}”."
            );
            exit;
        }
        #echo $upload;
        // agora você pode armazenar nos campos do seu $ship:
        $ship->shipConciergeNoContentImage = $newFileName . $ext;
        

        if(file_exists(UPLOAD_DIR .DS. $ship->shipConciergeNoContentImage)){
            // obtem as dimensos da imagem 
            list($width, $height) = getimagesize(UPLOAD_DIR .DS. $newFileName.$ext);
            $ship->shipConciergeNoContentImageDimensions = $width.' x '.$height;   
        } // 

        // Defina o novo nome do arquivo para o objeto para salvar no BD
        #$ship->shipFileOriginal = $fileName; // Save the original file name
        $ship->shipConciergeNoContentImageSize = $fileSize;
        $ship->shipConciergeNoContentImage = $newFileName.$ext; // Save the new file name
    } // end newFileName

    if ($_FILES["shipRestaurantNoContentImageNew"]["name"]) {
        $fileName = $_FILES["shipRestaurantNoContentImageNew"]["name"];
        $fileSize = $_FILES["shipRestaurantNoContentImageNew"]["size"];
        
        $ext = f_lower(f_fileextension($fileName));

        // Verifique se o arquivo é uma imagem PNG, JPG ou JPEG
        if (!in_array($ext, [".png"])) {
            $_SESSION[CONTAINER_NAME . "_messages_form"]["tp"] = 'error';
            $_SESSION[CONTAINER_NAME . "_messages_form"]["text"] = "Error: The file must be PNG, JPG, JPEG or WebP!";
            echo f_goto($goToError);
            exit;
        }
        
        // Use UUID como o novo nome do arquivo
        $newFileName =  $shipUUID.'_restaurant_nocontent';
        #$newFileName = $dpUUID."{$ext}"; // new name of file with UUID registered

        #echo $newFileName . BR;
        $noContentFileName = 'no_content';

        // 1) mova o upload para UPLOAD_DIR
        $upload = new UploadFile(
            $_FILES["shipRestaurantNoContentImageNew"],
            UPLOAD_DIR,
            $newFileName
        );

        // 2) copie o arquivo já movido para o outro diretório
        $origPath = $upload->getFullPath();               // ex: /var/www/html/nocontent/uuid_concierge_nocontent.png
        $targetPath = NOCONTENT_RESTAURANT_DIR
                    . DS
                    . $noContentFileName
                    . $ext;                              // ex: /var/www/html/concierge_nocontent/no_content.png

        if (!copy($origPath, $targetPath)) {
            throw new \RuntimeException(
                "Não foi possível copiar “{$origPath}” para “{$targetPath}”."
            );
            exit;
        }

        // agora você pode armazenar nos campos do seu $ship:
        $ship->shipRestaurantNoContentImage = $newFileName . $ext;
        
        #echo $upload;
        

        if(file_exists(UPLOAD_DIR .DS. $ship->shipRestaurantNoContentImage)){
            // obtem as dimensos da imagem 
            list($width, $height) = getimagesize(UPLOAD_DIR .DS. $newFileName.$ext);
            $ship->shipRestaurantNoContentImageDimensions = $width.' x '.$height;   
        } // 

        // Defina o novo nome do arquivo para o objeto para salvar no BD
        #$ship->shipFileOriginal = $fileName; // Save the original file name
        $ship->shipRestaurantNoContentImageSize = $fileSize;
        $ship->shipRestaurantNoContentImage = $newFileName.$ext; // Save the new file name

        
    } // end newFileName

    // verifica se existe outro daily menu ativo e altera o status caso esteja ativo
    if ($action == "ins") {
        $shipActive = (new ConciergeShips())->find("shipCode=:code AND shipStatus=:st AND deleted_at IS NULL","code={$ship->shipCode}&st=1")->count();
        if ($shipActive>0) {
            $ship->shipStatus = 0;
        }
    }
    if ($action == "upd") {
        $shipActive = (new ConciergeShips())->find("shipCode=:code AND shipUUID!=:uuid AND shipStatus=:st AND deleted_at IS NULL","code={$ship->shipCode}&uuid={$ship->shipUUID}&st=1")->count();
        if ($shipActive>0) {
            $ship->shipStatus = 0;
        }
    }
    //exit;

    // LOG
    $log = new SysLogs();
    $log->logAction = $action;
    $log->logDateTime = date('Y-m-d H:i:s');
    $log->managerUUID = f_decode($_SESSION['mUUID']);
    $log->logIP = f_ip();
    $log->logPage = "conciergeShips.sbm";
    $log->logData = json_encode($_POST);
    $log->created_by = f_decode($_SESSION['mID']);
    $log->logUUID = Uuid::uuid4();
    
    #echo 'aqui<br>';
    #exit;

    if (!$ship->save()) {
        $_SESSION[CONTAINER_NAME."_messages_form"]["tp"] = 'error';
        $_SESSION[CONTAINER_NAME."_messages_form"]["text"] = '<b>' . PAGE_NAME . '</b> não foi ' . $actionText . ', ocorreu um erro! ' . $ship->fail()->getMessage();
        $log->logActionResult = 'Fail!';
        $log->save();
        if ($ship->fail()) {
            $error = $ship->fail()->getMessage();
            echo $error . "<br>";
            f_dump($ship->data());
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
