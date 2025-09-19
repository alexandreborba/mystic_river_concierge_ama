<?php
@session_start();
require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../src/Parameters.php';
require_once __DIR__. '/../src/Functions.php';
require_once __DIR__. '/../src/Tools/Translator.php';
include_once __DIR__. "/__session_verify.php";
ini_set("display_errors", 0);
#error_reporting(E_ALL);

use Src\Models\SysNavs;

if($_POST["navSubGroupUUID"]){

    $navSubGroupUUID = f_security($_POST["navSubGroupUUID"]);
    $navs = (new SysNavs())->find("navSubGroupUUID=:uuid AND navStatus=:st AND deleted_at IS NULL", "uuid={$navGroupUUID}&st=1")->order("navSeq")->fetch(true);
    
    if($navs){
        echo '<option value=""> - Selecione um Item - </option>';
        foreach($navs as $nav){
           echo '<option value="'.$nav->navUUID.'">'.$nav->navName.'</option>';
        }

    } // end if
    else {
        echo '<option value=""> - Nenhum Item para este SubGrupo ! - </option>';
    }
} // end if