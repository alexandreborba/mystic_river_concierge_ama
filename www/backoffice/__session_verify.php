<?php 
/*
@ini_set('session.gc_maxlifetime', 5760);
@session_start();
#f_dump($_SESSION);
#echo $_SESSION[CONTAINER_NAME."_mRef"];
if(!$_SESSION[CONTAINER_NAME."_mRef"]){
    $_SESSION[CONTAINER_NAME."_msg"]["text"] = "<strong style='color:black'> > Session Verify is Time Out!<br>Login Again please.</strong>";
    echo "<script>alert('Session Verify is Time Out ! Bye');</script>";
    echo "<script>location.href='.';</script>";
    die();
}
*/
?>
<?php

    @ini_set('session.gc_maxlifetime', 5760);
    @session_start();
    #f_dump($_SESSION);
    #echo $_SESSION[CONTAINER_NAME."_mRef"];
    if(!$_SESSION[CONTAINER_NAME."_mRef"]){
        // LOG AUTOMÁTICO DE ERRO DE SESSÃO
        $logFile = __DIR__ . '/session_error.log';
        $logMsg = date('Y-m-d H:i:s') . "\n";
        $logMsg .= 'CONTAINER_NAME: '.(defined('CONTAINER_NAME') ? CONTAINER_NAME : 'NÃO DEFINIDO')."\n";
        $logMsg .= 'PHPSESSID: '.(isset($_COOKIE['PHPSESSID']) ? $_COOKIE['PHPSESSID'] : 'NÃO ENVIADO')."\n";
        $logMsg .= 'SESSION: '.print_r($_SESSION, true)."\n--------------------------\n";
        @file_put_contents($logFile, $logMsg, FILE_APPEND);
        $_SESSION[CONTAINER_NAME."_msg"]["text"] = "<strong style='color:black'> > Session Verify is Time Out!<br>Login Again please.</strong>";
        echo "<script>alert('Session Verify is Time Out ! Bye');</script>";
        echo "<script>location.href='.';</script>";
        die();
    }

?>