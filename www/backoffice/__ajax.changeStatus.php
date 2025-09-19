<?php
@session_start();
require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../src/Parameters.php';
require_once __DIR__. '/../src/Functions.php';
require_once __DIR__. '/../src/Tools/Translator.php';
// include_once __DIR__. "/__session_verify.php";
ini_set("display_errors", 0);
#error_reporting(E_ALL);

# echo '<pre>'.json_encode($_POST).'</pre>';exit;

if ($_POST["action"] == "changeStatus") {
    
    $model      = trim($_POST['model']       ?? ''); // qual nome do Model
    $uuid       = trim($_POST['uuid']        ?? ''); // qual valor do UUID
    $stField    = trim($_POST['statusField'] ?? ''); // qual o campo de status
    $stArrayField = trim($_POST['statusArrayField'] ?? ''); // qual o campo de status
    $fieldQuery = trim($_POST['fieldQuery']  ?? ''); // qual o campo de consulta no model

    // Monta a classe
    $class = "\\Src\\Models\\{$model}";
    if (! class_exists($class)) {
        echo json_encode(["success"=>false, "message"=>"Model {$class} não encontrada."]);
        exit;
    }

    // Busca o registro pelo UUID 
    $query = "{$fieldQuery}=:uuid AND deleted_at IS NULL";    
    $bind = "uuid={$uuid}";
    $count = (new $class())
        ->find($query, $bind)
        ->count();

    $register = (new $class())
        ->find($query, $bind)
        ->fetch();

    if (!$register->created_at) {
        echo json_encode([
          "success" => false,
          "message" => "{$count} Registros em {$query}"
        ]);
        exit;
    }

    // Alterna o status (supondo 1 <-> 0)
    $newStatus = ($register->{$stField} == "1") ? "0" : "1";
    $register->{$stField} = intval($newStatus);

    $register->updated_by = 
        isset($_SESSION[APP."_".$_SESSION[APP."_M"]."_mRef"]) 
          ? f_decode($_SESSION[APP."_".$_SESSION[APP."_M"]."_mRef"]) 
          : 0;

    if(!$register->save()){
        echo json_encode([
          "success" => false,
          "message" => "Erro ao salvar o status: {$register->getError()}"
        ]);
        exit;
    }
    $_SESSION[APP."_messages_form"]["tp"] = 'success';
    $_SESSION[APP."_messages_form"]["text"] = "Status Changed to <strong> {$$stArrayField[$newStatus]}</strong> SUCCESSFULLY!";
    // Grava log do sistema
    echo json_encode(["success" => true, "newStatus" => $newStatus]);
    exit;
    
    
} // end if action changeStatus