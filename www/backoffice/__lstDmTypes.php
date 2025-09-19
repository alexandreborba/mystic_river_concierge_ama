<?php
@session_start();
require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../src/Parameters.php';
require_once __DIR__. '/../src/Functions.php';
require_once __DIR__. '/../src/Tools/Translator.php';
include_once __DIR__. "/__session_verify.php";
ini_set("display_errors", 0);
#error_reporting(E_ALL);

use Src\Models\DailyMenusTypes;


$dmTypes = (new DailyMenusTypes())->find("dmTypeStatus=:st AND deleted_at IS NULL","st=1")->fetch(true);
$lstMenuTypes = [];
$lstMenuTypes[0] = ' > Select the type of menu';
if($dmTypes){
    foreach ($dmTypes as $dmType) {
        $lstMenuTypes[$dmType->dmTypeUUID] = $dmType->dmTypeName;
    } // end foreach
} // end if
