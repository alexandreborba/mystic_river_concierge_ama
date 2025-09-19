<?php
@session_start();
require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../src/Parameters.php';
require_once __DIR__. '/../src/Functions.php';
require_once __DIR__. '/../src/Tools/Translator.php';
include_once __DIR__. "/__session_verify.php";
ini_set("display_errors", 0);
#error_reporting(E_ALL);

use Src\Models\SysNavSubGroups;

if($_POST["navGroupUUID"]){

    $navGroupUUID = f_security($_POST["navGroupUUID"]);
    $navSubGroups = (new SysNavSubGroups())->find("navGroupUUID=:uuid AND navSubGroupStatus=:st AND deleted_at IS NULL", "uuid={$navGroupUUID}&st=1")->order("navSubGroupSeq")->fetch(true);
    
    if($navSubGroups){
        echo '<option value="0"> - Selecione o Sub Grupo - </option>';
        echo '<option value=""> > Sem Sub Grupo - </option>';
        foreach($navSubGroups as $navSubGroup){
           echo '<option value="'.$navSubGroup->navSubGroupUUID.'">'.$navSubGroup->navSubGroupName.'</option>';
        }

    } // end if
    else {
        echo '<option value="0"> - Nenhum SubGrupo para este Grupo ! - </option>';
        echo '<option value=""> > Sem Sub Grupo - </option>';
    }
} // end if