<?php
@session_start();
require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../src/Parameters.php';
require_once __DIR__. '/../src/Functions.php';
//include_once __DIR__ . "/__session_verify.php";
ini_set("display_errors",0);

// $msg = f_welcomeMessage()
$msg = f_welcomeMessage(); 
// Cookies lembrar meu e-mail

/*
if(isset($_COOKIE["email_login"])) {
  // $loginEmail = f_decode($_COOKIE["email_login"]);
  $loginEmail = f_lower(f_decode((filter_var(trim($_COOKIE["email_login"]), FILTER_SANITIZE_EMAIL))));
}else{
  $loginEmail = null;
} 
*/

$loginEmail = (isset($_COOKIE[CONTAINER_NAME."_email_login"])) ? f_lower(f_decode(f_security($_COOKIE[CONTAINER_NAME."_email_login"]))) : null ;
$checked = ($loginEmail) ? "checked" : null;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title><?=BACKOFFICE_TITLE?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- Favicon/x-icon 180X180 -->
    <!-- <link rel="shortcut icon" href="../images/favicons/favicon.ico" type="image/x-icon"> -->
    <!--  <link rel="icon" href="../images/favicons/favicon.ico" type="image/x-icon"> -->

    <link href="assets/plugins/jquery-notifications/css/messenger.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/jquery-notifications/css/messenger-theme-flat.css" rel="stylesheet" type="text/css" media="screen" />

    <!-- BEGIN PLUGIN CSS -->
    <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/bootstrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="assets/plugins/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
    <!-- https://github.hubspot.com/messenger/docs/welcome/ -->
    <!-- END PLUGIN CSS -->
    <!-- BEGIN CORE CSS FRAMEWORK -->
    <link href="webarch/css/webarch.css" rel="stylesheet" type="text/css" />
    <link href="webarch/css/custom.css" rel="stylesheet" type="text/css" />
    <!-- END CORE CSS FRAMEWORK -->
  </head>
  <!-- END HEAD -->
  <!-- BEGIN BODY -->
  <body class="error-body no-top lazy" style="background-image: url('<?=IMG_LOGIN_BACKGROUND?>?<?=f_dateimagerenew()?>');background: no-repeat center center cover;">
    <div class="container">
      <div class="row login-container animated fadeInUp">
        <div class="col-md-7 col-md-offset-2 tiles white no-padding">
          <div class="p-t-30 p-l-40 p-b-20 xs-p-t-10 xs-p-l-10 xs-p-b-10">
            
            <h2 class="normal"><?=TITLE_LOGIN?></h2>
            <h3 class="normal"><?=shipName.' | '.shipCode?></h3>
            <?php echo ($msg[1]) ? "<h4 style='color:#02244F'>".$msg[1]."</h4>" : null; ?>
            <?php echo ($msg[2]) ? "<h4 class='p-b-20' style='color:#02244F'>".$msg[2]."</h4>" : null; ?>
            
          </div>

          <div class="tiles grey p-t-20 p-b-20 no-margin text-black tab-content">
            <div role="tabpanel" class="tab-pane active" id="tab_login">

              <form class="animated fadeIn validate" name="form_login" method="post" action="index.sbm" autocomplete="false">

              <input type="hidden" name="action" value="login">

                <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                  <div class="col-md-6 col-sm-6">
                    <label for="loginEmail" style="color:#000">E-mail</label>
                    <input type="email" style="text-transform: lowercase;"  class="form-control" id="loginEmail" name="loginEmail" placeholder="your email" autocomplete="false" value="<?=$loginEmail?>" >
                    <label id="loginEmail" style="color:red;font-size:12px;" class="form-label error"></label>
                  </div>
                  <div class="col-md-6 col-sm-6" >
                    <label for="loginPassword" style="color:#000">Password <a href="#" name="hide_password" style="padding-left:5%">show</a></label>
                    <input type="password" class="form-control" id="loginPassword" name="loginPassword" placeholder="your password" autocomplete="false"  >
                    <label id="loginPassword" style="color:red;font-size:12px" class="form-label error"></label>
                  </div>
                </div>

                <div class="row p-t-10 m-l-20 m-r-20 xs-m-l-10 xs-m-r-10 m-b-10">
                  <div class="control-group col-md-10">
                    <div class="checkbox checkbox check-success">
                      <input id="checkbox1" type="checkbox" name="remember" <?=$checked?> >
                      <label for="checkbox1">Remember my e-mail</label>
                    </div>
                  </div>
                </div>

                <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                  <div class="col-md-12 col-sm-12 text-left" >
                  <button type="buttom" class="btn btn-primary" name="btnSubmit">Enter</button>
                  </div>
                </div>
                <!--
                <div class="row p-t-10 m-b-10 m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                  <div class="col-md-12 col-sm-12 text-right">
                    <a href="#" name="forgot" oncontextmenu="return false;">Forgot your password ?</a>
                  </div>
                </div>
                -->
                <div class="row p-t-10 m-b-10 m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                  <div class="col-md-12 col-sm-12 text-left" style="color:#696969;margin-top:1%">
                    <?=f_lower(CONTAINER_NAME)?> 
                  </div>
                </div>
                
              </form>

              <div class="row p-t-10 m-b-10 m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                  <div class="col-md-12 col-sm-12 text-right">
                    <div id="session-messages">
                    <?php 
                      
                      if(!empty($_SESSION[CONTAINER_NAME."_msg"])){
                        echo "<div class='login-form__row text-center'>";
                        echo (isset($_SESSION[CONTAINER_NAME."_msg"]["text"])) ? $_SESSION[CONTAINER_NAME."_msg"]["text"] : null;
                        echo "</div>";
                        unset($_SESSION[CONTAINER_NAME."_msg"]);
                      }
                      session_destroy();
                      
                    ?>	
                    </div>
                  </div>
              </div>

            </div>
            
          </div>
        </div>
      </div>
    </div>
    <!-- END CONTAINER -->
    <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <!-- BEGIN JS DEPENDECENCIES-->
    <script src="assets/plugins/jquery/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrapv3/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-block-ui/jqueryblockui.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
    <!-- <script src="assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script> -->
    <script src="assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>

    <!-- MESSAGES -->
    <script src="assets/plugins/jquery-notifications/js/messenger.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-notifications/js/messenger-theme-flat.js" type="text/javascript"></script>
    <!-- end MESSAGES -->

    <!-- END CORE JS DEPENDECENCIES-->
    <!-- BEGIN CORE TEMPLATE JS -->
    <!-- <script src="webarch/js/webarch.js" type="text/javascript"></script> -->
    <script src="assets/js/chat.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/js/notifications.js"></script>
    <!-- END CORE TEMPLATE JS -->

    <script>
      $(document).ready(function () {
        Messenger.options = {
          extraClasses: 'messenger-fixed messenger-on-top',
          theme: 'future'
      }
        
        $('input[name=loginPassword]').keypress(function (e) {
          var keyCode = e.keyCode ? e.keyCode : e.which;       
          if (keyCode == 13) 
          {
            e.preventDefault();
            $("button[name='btnSubmit']").click();
            return false; 
          }
        });

        $("a[name='hide_password']").click(function(e){
          e.preventDefault();
          if($("input[name=loginPassword]").attr("type") == "password"){
            $("input[name=loginPassword]").attr("type", "text");
            $(this).text("hide");
          }else{
            $("input[name=loginPassword]").attr("type", "password");
            $(this).text("show");
          }
        });

        $("a[name='forgot']").click(function(e){
          e.preventDefault();
          if($("input[name=loginEmail]").val() == ""){
            let msg = "Enter your e-mail address to recover your password!";

            Messenger().post({
              message: msg,
              type: 'error',
              hideAfter: 5,
              hideOnNavigate: true,
              showCloseButton: false
	          });	

            return false;
          }else{
            document.location.href = "forgot-password?ref="+$("#loginEmail").val();
          }
          
        });
        
        $("button[name='btnSubmit']").click(function(e){
          e.preventDefault();
          
          var validate = formValidate();
          
          if(formValidate()=== true) {
            // submit
            $("form").submit();
            return;

          }else{
            // show errors
            showValidateResult();
            return;
          }
        });

      function showValidateResult(){
        $("#session-messages").html("");
        $("#session-messages").html("<div class='alert alert-danger' role='alert' style='text-align:left'><strong>Atenção!</strong><br><ul id='msg_errors'></ul></div>");
        $("#msg_errors").html("");
        $.each(JSON.parse(sessionStorage.getItem('errors')), function (key, value) {
          $("#msg_errors").append("<li>"+value[1]+"</li>");
          $("#"+value[0]).addClass("is-invalid");
        });
      } // end function showValidateResult

      function formValidate(){
        console.log('formValidate');
        let err = [];
        
        if ($("input[name=loginEmail]").val() == "") ) {
          err.push(['loginEmail', 'Informe um E-mail valido!']);
        }
        if (($("input[name=loginPassword]").val() == "") || ($("input[name=loginPassword]").val().length < 4)) {
          err.push(['loginPassword', 'Informe uma Password válida!']);
        }
			  sessionStorage.setItem('errors', JSON.stringify(err));

        if(err.length==0) {
          return true;
        }
        else{
          return false;
        }
      } // end function formValidate
		
      function validMail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
      } // .function

    });
  </script>
    
  </body>
</html>