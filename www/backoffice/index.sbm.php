<?php
ob_start();
@session_start();
#echo "Session ID: " . session_id();
require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../src/Parameters.php';
require_once __DIR__. '/../src/Functions.php';

ini_set("display_errors",0);
// error_reporting(E_ALL);

use Src\Models\SysManagers;
use Src\Models\SysLogs;
use Ramsey\Uuid\Uuid;


if(isset($_POST['action']) && $_POST['action'] == 'login') {

    $email = f_security(trim($_POST["loginEmail"]));
    $psw = f_security(trim($_POST["loginPassword"]));
    $pswHash = f_md5Invert($psw);
    

    // LOG
    $log = new SysLogs();
    $log->logAction = 'login (manager)';
    $log->logDateTime = date('Y-m-d H:i:s');
    $log->logIP = f_ip();
    $log->logPage = "_index.sbm";
    
    #$log->created_by = f_decode($_SESSION[CONTAINER_NAME."_mID"]);
    $log->logUUID = Uuid::uuid4();
    $log->logPlataform = 'Managers';

    #echo $email . ' - ' . $psw . ' : ' .$pswHash; exit;

    if($_POST["remember"] == 'on'){
        @setcookie(CONTAINER_NAME."_email_login", "", time() - 3600);
        @setcookie(CONTAINER_NAME."_email_login", f_encode(trim(f_lower(f_security($email)))), time() + (10 * 365 * 24 * 60 * 60));
    }else{
        # unset($_COOKIE['email_login']);
        setcookie(CONTAINER_NAME.'_email_login', null, -1);
    }
  
    try {
        $mngr = (new SysManagers())->find("managerEmail=:email AND managerPSWHash=:pass AND managerStatus=:st AND deleted_at IS NULL","email={$email}&pass={$pswHash}&st=1")->fetch();
        if($mngr->managerUUID){
            $log->logActionResult = 'Success!';
            $_SESSION[CONTAINER_NAME."_mID"]        = f_encode($mngr->managerID);
            $_SESSION[CONTAINER_NAME."_mRef"]       = f_encode($mngr->managerID);
            $_SESSION[CONTAINER_NAME."_mUUID"]      = f_encode($mngr->managerUUID);
            $_SESSION[CONTAINER_NAME."_mName"]      = f_encode($mngr->managerName);
            $_SESSION[CONTAINER_NAME."_mUName"]     = f_encode($mngr->managerUsername);
            $_SESSION[CONTAINER_NAME."_mEmail"]     = f_encode($mngr->managerEmail);
            $_SESSION[CONTAINER_NAME."_mFunction"]  = f_encode($mngr->managerFunction);
            $_SESSION[CONTAINER_NAME."_mPerm"]      = f_encode($mngr->managerPerm);
            $_SESSION[CONTAINER_NAME."_mLang"]      = f_encode($mngr->langCode);
            $_SESSION[CONTAINER_NAME."_mAD"]        = f_encode($mngr->managerAdm);
            # $_SESSION["uTkn"]   = f_encode($user->admToken);
           
            #echo '<pre>'.json_encode($_SESSION).'</pre>'.BR; exit;

            $_POST['loginPassword'] = $pswHash;
            $log->managerUUID = $mngr->managerUUID;
            $log->logData = json_encode($_POST);

            $log->save(); // save log
            header("Location: __master", true, 302);
            ob_end_flush();
            # var_dump($_SESSION);
        }else{
            
            $log->logActionResult = 'Fail!';
            $_SESSION['msg']["type"] = 'error';
            $_SESSION['msg']["text"] = "<strong style='color:red'> > E-mail ou senha inválidos, acesso negado! </strong>";
            $log->logData = json_encode($_POST);
            $log->save(); // save log
            header("Location: .");
            ob_end_flush();
        }
    } catch (exception $e) {
        //echo 'erro!';
        $log->logActionResult = 'Fail!';
        $log->logData = json_encode($_POST);
        $log->save(); // save log
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    } 

} else {
    #$log->logData = json_encode($_POST);
    #$log->save(); // save log
     header("Location: .");
     ob_end_flush();
   
} // $_POST['action']

?>