<?php
@session_start();
require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../src/Parameters.php';
require_once __DIR__. '/../src/Functions.php';
require_once __DIR__. '/../src/Tools/Translator.php';
include_once __DIR__. "/__session_verify.php";
ini_set("display_errors", 0);
#error_reporting(E_ALL);

if($_SESSION['lang']) {
    $langCode = $_SESSION['lang'];
} else {
    $langCode = ($_SESSION[CONTAINER_NAME."_mLang"]) ? f_decode($_SESSION[CONTAINER_NAME."_mLang"]): 'en';
    $_SESSION['lang'] = $langCode;  
}
$dict = new Translator();
$sCode = shipCode;

use Src\Models\SysLanguages;
$lstLanguages = [];
$languages = (new SysLanguages())->find("langStatus=:st AND deleted_at IS NULL", "st=1")->fetch(true);
if ($languages) {
    $lstLanguages[''] = ' -- '.f_caption($dict->translate('select'), $langCode).' -- ';
    foreach ($languages as $lang) {
        $lstLanguages[$lang->langCode] = f_caption($dict->translate($lang->langName, $langCode));
    }
}