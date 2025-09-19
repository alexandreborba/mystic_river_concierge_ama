<?php

@session_start();
require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../src/Parameters.php';
require_once __DIR__. '/../src/Functions.php';

ini_set("display_errors",0);
$msg = f_welcomeMessage(); 
// Cookies lembrar meu e-mail

use Src\Models\SysManagers;

$managerUUID = ($_GET["ref"]) ? $_GET["ref"] : null; // recebe o UUID coded

if($managerUUID != null){

  // validar o UUID
  $uuid = f_decode($managerUUID);
  // echo $uuid; exit;
  $manager = (new SysManagers())->find("managerUUID = :uuid AND managerStatus=:st AND managerPSWReset=:reset", "uuid={$uuid}&st=1&reset=1")->fetch();
  if($manager){
    // $managerEmail = $manager->managerEmail;

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
    <!-- <link rel="shortcut icon" href="../images/favicons/favicon.ico" type="image/x-icon">-->
        <!-- <link rel="icon" href="../images/favicons/favicon.ico" type="image/x-icon"> -->

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
            <h2 class="normal">Reset da Password </h2>
            <?php echo ($msg[1]) ? "<h3 style='color:#02244F'>".$msg[1]."</h3>" : null; ?>
            <?php echo ($msg[2]) ? "<h4 class='p-b-20' style='color:#02244F'>".$msg[2]."</h4>" : null; ?>
            
          </div>

          <div class="tiles grey p-t-20 p-b-20 no-margin text-black tab-content">
            <div role="tabpanel" class="tab-pane active" id="tab_login">

              <form class="animated fadeIn validate" name="form_reset" method="post" action="_reset-your-password.sbm" autocomplete="false">
                <input type="hidden" name="action" value="reset">
                <input type="hidden"  class="form-control" id="resetUUID" name="resetUUID" placeholder="" value="<?=$managerUUID?>" >

                <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                  
                  <div class="col-md-6 col-sm-6" >
                    <label for="resetPassword" style="color:#000">Nova Password <a href="#" name="hide_password" style="padding-left:5%">mostrar</a></label>
                    <input type="password" class="form-control" id="resetPassword" name="resetPassword" placeholder="sua nova password" autocomplete="false"  >
                    <label id="resetPassword" style="color:red;font-size:12px" class="form-label error"></label>
                  </div>
                  <div class="col-md-6 col-sm-6" >
                    <label for="resetPasswordConfirm" style="color:#000">Repita a Password <a href="#" name="hide_password_confirm" style="padding-left:5%">mostrar</a></label>
                    <input type="password" class="form-control" id="resetPasswordConfirm" name="resetPasswordConfirm" placeholder="repita a nova password" autocomplete="false"  >
                    <label id="resetPassword" style="color:red;font-size:12px" class="form-label error"></label>
                  </div>
                </div>

                <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                  <div class="col-md-12 col-sm-12 text-left" >
                  <button type="buttom" class="btn btn-primary" name="btnSubmit">Save</button>
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
        
        $('input[name=resetPassword]').keypress(function (e) {
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
          if($("input[name=resetPassword]").attr("type") == "password"){
            $("input[name=resetPassword]").attr("type", "text");
            $(this).text("esconder");
          }else{
            $("input[name=resetPassword]").attr("type", "password");
            $(this).text("mostrar");
          }
        });

        $("a[name='hide_password_confirm']").click(function(e){
          e.preventDefault();
          if($("input[name=resetPasswordConfirm]").attr("type") == "password"){
            $("input[name=resetPasswordConfirm]").attr("type", "text");
            $(this).text("esconder");
          }else{
            $("input[name=resetPasswordConfirm]").attr("type", "password");
            $(this).text("mostrar");
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
        
        if (($("input[name=resetPassword]").val() == "") || ($("input[name=resetPassword]").val().length < 4)) {
          err.push(['resetPassword', 'Informe uma Password válida!']);
        }
        if (($("input[name=resetPasswordConfirm]").val() == "") || ($("input[name=resetPasswordConfirm]").val().length < 4) || ($("input[name=resetPassword]").val() != $("input[name=resetPasswordConfirm]").val())) {
          err.push(['resetPasswordConfirm', 'Informe uma Password válida e identica a anterior!']);
        }
			  sessionStorage.setItem('errors', JSON.stringify(err));

        if(err.length==0) {
          return true;
        }
        else{
          return false;
        }
      } // end function formValidate
		
    });
  </script>

  <?php 
    }else{ 
        @header("Location: ."); 
        $_SESSION[CONTAINER_NAME."_msg"]["text"] = MESSAGE_MANAGER_FORGOT_PASSWORD_ERROR;
    } // Manager Validation error

  }else{ 
    @header("Location: ."); 
    $_SESSION[CONTAINER_NAME."_msg"]["text"] = '';
      // email is null
  }
  ?>
    
  </body>
</html>