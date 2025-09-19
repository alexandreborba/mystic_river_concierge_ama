<?php
#echo '<!-- DB Config Loaded -->' . chr(10);
#ini_set('session.gc_maxlifetime', 1800);
@ini_set('session.gc_maxlifetime', 2700);

#define("ROOT",THIS_HOST.dirname($_SERVER['SCRIPT_NAME']));

include_once 'DBSwitch.php';
#echo "<pre>"; var_dump($connCfg); echo "</pre>";

@ini_set("display_errors", 0);
define("DATA_LAYER_CONFIG", [
    "driver"    => $connCfg['driver'],
    "host"      => $connCfg['host'],
    "port"      => $connCfg['port'],
    "dbname"    => $connCfg['db_name'],
    "username"  => $connCfg['username'],
    "passwd"    => $connCfg['password'],
    "charset"   => 'utf8mb4',              // **for emoticons**
    "collation" => 'utf8mb4_unicode_ci',   // **for emoticons**
    "options"   => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

#echo '<!-- Depois do  DATA_LAYER_CONFIG -->'.chr(10);


