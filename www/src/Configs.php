<?php
require_once __DIR__ . "/../vendor/autoload.php";
include __DIR__ . "Functions.php";
include __DIR__ . "Parameters.php";

ini_set("display_errors", 0);

use Src\Models\SysConfigs;
$mdlConfig = new SysConfigs();
@session_start();
$configs = $mdlConfig->find("deleted_at IS NULL")->fetch(true);

if ($configs) {
    foreach ($configs as $config) {
        ${$config->cfgRef} = $config->cfgContent;
        # echo '<!-- '.$config->cfgRef.' : '.$config->cfgContent.' -->'.chr(13);
    } // end foreach
} // end if
echo '<!-- Configs Loaded ! -->'.chr(10);