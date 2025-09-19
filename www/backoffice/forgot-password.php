<?php

@session_start();
require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../src/Parameters.php';
require_once __DIR__. '/../src/Functions.php';
ini_set("display_errors",0);

$forgotEmail = ($_GET["ref"]) ? f_lower(filter_var(trim($_GET["ref"]), FILTER_SANITIZE_EMAIL)) : null;

$msg = f_welcomeMessage(); 

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

    <!-- BEGIN PLUGIN CSS -->
    <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/bootstrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="assets/plugins/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
    <!-- END PLUGIN CSS -->
    <!-- BEGIN CORE CSS FRAMEWORK -->
    <link href="webarch/css/webarch.css" rel="stylesheet" type="text/css" />
    <link href="webarch/css/custom.css" rel="stylesheet" type="text/css" />
    <!-- END CORE CSS FRAMEWORK -->
  </head>
  <!-- END HEAD -->
  <!-- BEGIN BODY -->
  <body class="error-body no-top lazy" data-original="<?=IMG_LOGIN_BACKGROUND?>?<?=f_dateimagerenew()?>" style="background-image: url('<?=IMG_LOGIN_BACKGROUND?>?<?=f_dateimagerenew()?>')">
    <div class="container">
      <div class="row login-container animated fadeInUp">
        <div class="col-md-7 col-md-offset-2 tiles white no-padding">
        <div class="p-t-30 p-l-40 p-b-20 xs-p-t-10 xs-p-l-10 xs-p-b-10">
          <!-- <img src="<?=IMG_LOGIN_LOGO?>?<?=f_dateimagerenew()?>" style="width:35%;padding:5px" /> -->
          <h2 class="normal"><?=TITLE_LOGIN?></h2>

          <h3 style='color:#02244F'>Esqueceu a Password ?</h3>

          <h4 style='color:#000'>Confirme seu e-mail de acesso para o reset de senha.</h4>

        </div>

          <div class="tiles grey p-t-20 p-b-20 no-margin text-black tab-content">
            <div role="tabpanel" class="tab-pane active" id="tab_login">

              <form class="animated fadeIn validate" name="form_forgot" method="post" action="_forgot-password.sbm" autocomplete="false">
                <input type="hidden" name="action" value="forgot">
                
                <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                  <div class="col-md-8 col-sm-8">
                    <label for="forgotEmail">E-mail</label>
                    <input class="form-control" id="forgotEmail" name="forgotEmail" placeholder="" type="email" autocomplete="false" value="<?=$forgotEmail?>">
                    <label id="forgotEmail" style="color:red;font-size:12px" class="form-label error"></label>
                  </div>
                  
                </div>

                <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                  <div class="col-md-12 col-sm-12 text-left" >
                  <button type="buttom" class="btn btn-primary" name="btnSubmit">Enviar</button>
                  </div>
                </div>


                <div class="row p-t-10 m-b-10 m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                  <div class="col-md-12 col-sm-12 text-right">
                    <a href="#" name="return" onMouseover="return false;" >Back para o Login</a>
                  </div>
                </div>
                
              </form>

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
    <script src="assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
    <!-- END CORE JS DEPENDECENCIES-->
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="webarch/js/webarch.js" type="text/javascript"></script>
    <script src="assets/js/chat.js" type="text/javascript"></script>
    <!-- END CORE TEMPLATE JS -->

    <script>
      $(document).ready(function () {
        
        $('input[name=forgotEmail]').keypress(function (e) {
          var keyCode = e.keyCode ? e.keyCode : e.which;       
          if (keyCode == 13) 
          {
            e.preventDefault();
            $("button[name='btnSubmit']").click();
            return false; 
          }
        });

        $("a[name='return']").click(function(e){
          e.preventDefault();
          let forgotEmail = $("input[name='forgotEmail']").val();
          document.location.href = ".?=" + forgotEmail;
        });
        
        $("button[name='btnSubmit']").click(function(e){
          e.preventDefault();
          // change btnSubmit to disabled and change text to 'Aguarde...'
          $("button[name='btnSubmit']").html("Aguarde...");
          $("button[name='btnSubmit']").attr("disabled", true);
          
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
        $("#session-messages").html("<div class='alert alert-danger' role='alert'><strong>Atenção!</strong> Verifique os erros abaixo:<br><ul id='msg_errors'></ul></div>");
        $("#msg_errors").html("");
        $.each(JSON.parse(sessionStorage.getItem('errors')), function (key, value) {
          $("#msg_errors").append("<li>"+value[1]+"</li>");
          $("#"+value[0]).addClass("is-invalid");
        });
      } // end function showValidateResult

      function formValidate(){
        let err = [];
        
        if (($("input[name=forgotEmail]").val() == "") || (!validMail($("input[name=forgotEmail]").val()))) {
          err.push(['forgotEmail', 'Informe um E-mail valido!']);
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