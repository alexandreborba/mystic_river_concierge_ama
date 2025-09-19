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

use Ramsey\Uuid\Uuid;
use Src\Models\SysManagers;

@define('PAGETITLE', 'Sua Contade Administrador/a');
@define('NEXT_PAGE', '_managers.sbm');
@define('PREVIUS_PAGE', '_managers.lst');

$id = ($_GET["ref"]) ? f_decode(filter_var(trim($_GET["ref"]), FILTER_SANITIZE_STRING)) : null;

$action = 'ins';
$newUUID = Uuid::uuid4();
$managerUUID = $newUUID;
// $episodeTime = '07:00';



if($id){
    $action = 'upd';
    $manager = (new SysManagers())->findById($id);
    foreach ($manager->Data() as $field => $value) {
        ${$field} = ($field !== "") ? trim($value) : null;
    }
    $managerUUID = (empty($managerUUID)) ? $newUUID : $managerUUID;
}

include "__lstLanguages.inc.php";

?>
<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="ie ie6 lte9 lte8 lte7"> <![endif]-->
<!--[if IE 7]>     <html class="ie ie7 lte9 lte8 lte7"> <![endif]-->
<!--[if IE 8]>     <html class="ie ie8 lte9 lte8"> <![endif]-->
<!--[if IE 9]>     <html class="ie ie9 lte9"> <![endif]-->
<!--[if gt IE 9]>  <html> <![endif]-->
<!--[if !IE]><!-->
<html>
  <!--<![endif]-->
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title><?=BACKOFFICE_TITLE?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="alexandre.borba@gmail.com" name="author" />
    <meta content="" name="description" />
    
    <!-- Favicon/x-icon 180X180 -->
    <link rel="shortcut icon" href="../images/favicons/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../images/favicons/favicon.ico" type="image/x-icon">


    <!-- BEGIN PLUGIN CSS -->
    <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrap-tag/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/dropzone/css/dropzone.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/ios-switch/ios7-switch.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" media="screen" />
    <!-- END PLUGIN CSS -->
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

    <!-- END CORE CSS FRAMEWORK -->
    <link rel="stylesheet" type="text/css" href="assets/dist/css/audio-player.min.css">
    <!-- END CORE CSS FRAMEWORK -->
  </head>
  <!-- END HEAD -->
  <!-- BEGIN BODY -->
  <body class="">
    <!-- BEGIN HEADER -->
    <div class="header navbar navbar-inverse ">
      <!-- BEGIN TOP NAVIGATION BAR -->
      <div class="navbar-inner">
        <div class="header-seperation">
          <ul class="nav pull-left notifcation-center visible-xs visible-sm">
            <li class="dropdown">
              <a href="#main-menu" data-webarch="toggle-left-side">
                <i class="material-icons">menu</i>
              </a>
            </li>
          </ul>
          <!-- BEGIN LOGO -->
            <!-- <img src="assets/img/logo_1x.png" class="logo" alt="" data-src="assets/img/logo_1x.png" data-src-retina="assets/img/logo_2x.png" width="160" /> -->
          <!-- END LOGO -->
          <ul class="nav pull-right notifcation-center">
            <li class="dropdown hidden-xs hidden-sm">
              <a href="__master" class="dropdown-toggle active" data-toggle="">
                <i class="material-icons">home</i>
              </a>
            </li>
          </ul>
        </div>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <div class="header-quick-nav">
          <!-- BEGIN TOP NAVIGATION MENU -->
          <div class="pull-left">
            <ul class="nav quick-section">
              <li class="quicklinks">
                <a href="#" class="" id="layout-condensed-toggle">
                  <i class="material-icons">menu</i>
                </a>
              </li>
            </ul>
            
          </div>

          <!-- END TOP NAVIGATION MENU -->
          
          <!-- BEGIN TOGGLER --> 
          <?php include_once "__toggler.php"; ?>
          <!-- END TOGGLER -->

        </div>
        <!-- END TOP NAVIGATION MENU -->
      </div>
      <!-- END TOP NAVIGATION BAR -->
    </div>
    <!-- END HEADER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container row">
      
      <!-- BEGIN SIDEBAR -->
      <div class="page-sidebar " id="main-menu">
        <!-- BEGIN MINI-PROFILE -->
        <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
          
          <!-- END MINI-PROFILE -->
          <!-- BEGIN SIDEBAR MENU -->
          <?php require_once "__sidebar.php"; ?>
          <!-- END SIDEBAR MENU -->
        </div>
      </div>
      <a href="#" class="scrollup">Scroll</a>
      <div class="footer-widget" style="text-align:center;color:#696969">
        <?=(shipCode) ? shipCode.' | '.shipName.BR : '';?>
        <?=f_ajustDateTime(f_datetime());?>
      </div>
      <!-- END SIDEBAR -->
      <!-- BEGIN PAGE CONTAINER-->
      <div class="page-content">
        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        
        <div class="content">
          
          <div class="page-title">
        
            <h3><span class="semi-bold"><?=$actionsTitles[$action]?></span></h3>
          </div>
          <!-- BEGIN BASIC FORM ELEMENTS-->
          <div class="row">
            <div class="col-md-12">
              <div class="grid simple">
                <div class="grid-title no-border" style="padding:10px 0px 10px 20px">
                  <h3><span class="semi-bold" style="color:#580826">Administrador/a</span></h3>
                  <hr>
                </div>
                
                <div class="grid-body no-border">
                  
                  <form name="form" action="<?=NEXT_PAGE?>" method="post" enctype="multipart/form-data">
                  <input type="hidden" id="action" name="action" value="<?=$action?>">
                  <?php 
                  if($action="upd"){ 
                    echo ($managerID) ?           chr(10).chr(9).chr(9).chr(9).chr(9)."<input type='hidden' id='managerID' name='managerID' value='{$managerID}'>".chr(10) :null;
                    echo ($managerUUID) ?         chr(9).chr(9).chr(9).chr(9)."<input type='hidden' id='managerUUID' name='managerUUID' value='{$managerUUID}'>".chr(10) :null;
                    echo ($managerPSWHash) ?      chr(9).chr(9).chr(9).chr(9)."<input type='hidden' id='managerPSWHash' name='managerPSWHash' value='{$managerPSWHash}'>".chr(10) :null;
                    echo ($managerPSWReset) ?     chr(9).chr(9).chr(9).chr(9)."<input type='hidden' id='managerPSWReset' name='managerPSWReset' value='{$managerPSWReset}'>".chr(10) :null;
                    echo ($managerPerm) ?         chr(9).chr(9).chr(9).chr(9)."<input type='hidden' id='managerPerm' name='managerPerm' value='{$managerPerm}'>".chr(10) :null;
                  } // end if
                  ?>
                  <!-- row -->  
                  <div class="row">

                    <div class="col-md-1 col-sm-1 col-xs-1">
                      <div class="form-group">
                        <label class="form-label">ID</label>
                        <div class="controls">
                          <p><?=$managerID?></p>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-11 col-sm-11 col-xs-11">
                      <div class="form-group">                        
                        <label class="form-label">UUID</label>
                        <div class="controls">
                          <p><?=$managerUUID?></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-5">
                    </div>
                  </div> 
                  <!-- end row -->

                  <hr>

                  <!-- row -->  
                  <div class="row">

                    <div class="col-md-3 col-sm-3 col-xs-3">
                      <div class="form-group">
                        <label class="form-label">Nome</label>
                        <span class="help"></span>
                        <div class="controls">
                          <input type="text" id="managerName" name="managerName"  class="form-control" style="font-weight:bold"  value="<?=$managerName?>">
                          <label id="managerName" style="padding-left:5px;font-size:12px" class="form-label error"></label>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-2">
                      <div class="form-group">
                        <label class="form-label">Username</label>
                        <span class="help"></span>
                        <div class="controls">
                          <input type="text" id="managerUsername" name="managerUsername"  class="form-control" style="font-weight:bold"  value="<?=$managerUsername?>">
                          <label id="managerUsername" style="padding-left:5px;font-size:12px" class="form-label error"></label>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-2">
                      <div class="form-group">
                        <label class="form-label">Cargo/Função</label>
                        <span class="help"></span>
                        <div class="controls">
                          <input type="text" id="managerFunction" name="managerFunction"  class="form-control" style="font-weight:bold"  value="<?=$managerFunction?>">
                          <label id="managerFunction" style="padding-left:5px;font-size:12px" class="form-label error"></label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- end row -->

                  <!-- row -->  
                  <div class="row">

                    <div class="col-md-3 col-sm-3 col-xs-3">
                      <div class="form-group">
                        <label class="form-label">E-mail</label>
                        <span class="help"></span>
                        <div class="controls">
                          <input type="text" id="managerEmail" name="managerEmail"  class="form-control" style="font-weight:bold"  value="<?=$managerEmail?>">
                          <label id="managerEmail" style="padding-left:5px;font-size:12px" class="form-label error"></label>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-2">
                      <div class="form-group">
                        <label class="form-label">Telemóvel</label>
                        <span class="help"></span>
                        <div class="controls">
                          <input type="text" id="managerTlm" name="managerTlm"  class="form-control" style="font-weight:bold"  value="<?=$managerTlm?>">
                          <label id="managerTlm" style="padding-left:5px;font-size:12px" class="form-label error"></label>
                        </div>
                      </div>
                    </div>

                  </div> 
                  <!-- end row -->

                  <!-- Row -->
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <div class="form-group">
                            <label class="form-label">Idioma / Linguagem</label>
                            <span class="help"></span>
                            <div class="controls">
                                <select class="form-control" name="langCode" id="langCode">
                                    <?php 
                                    if (empty($lstLanguages)) {
                                        echo "<option value=''>No language available</option>";
                                    } else {
                                        foreach ($lstLanguages as $key => $value) {
                                            $selected = ($key == $langCode) ? 'selected' : '';
                                            echo "<option value='$key' $selected>$value</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <label id="langCode" style="padding-left:5px;font-size:12px" class="form-label error"></label>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- end row -->

                  <!-- row -->  
                  <div class="row">

                    <div class="col-md-4 col-sm-4 col-xs-4">
                      <div class="form-group">
                        <label class="form-label">Nova Password</label>
                        <span class="help"></span>
                        <div class="controls">
                          <input type="password" id="managerPSWHashNew" name="managerPSWHashNew"  class="form-control" style="font-weight:bold" >
                          <label id="managerPSWHashNew" style="padding-left:5px;font-size:12px" class="form-label error"></label>
                        </div>
                      </div>
                    </div>

                    

                  </div> 
                  <!-- end row -->

                  <!-- row -->  
                  <div class="row">
                  <div class="col-md-6 col-sm-6 col-xs-6">
                      <div class="form-group">
                        <label class="form-label"><font style='color:red'>Admin Permission</font></label>
                        <span class="help"></span>
                        <div class="controls">
                          <?php $checked = ($managerAdm==1) ? 'checked' : null ;?>
                          <label class='form-check-label' for='managerAdm'>
                          <input class='form-check-input' type='checkbox' id='managerAdm' name='managerAdm' <?=$checked?> >&nbsp;Yes</label>
                        </div>
                      </div>
                    </div>

                  </div> 
                  <!-- end row -->

                  <!-- row -->  
                  <!--
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                      <label class="form-label">Permissões</label>
                      </div> 
                    </div> 
                  </div> 
                  -->
                  <!-- end row -->

                  <!-- row -->  
                  <div class="row">

                  <div class="col-md-2 col-sm-2 col-xs-2">
                    <div class="form-group">
                      <label class="form-label">Status</label>
                      <span class="help">Inativo / Ativo </span>
                      <div class="controls">
                        <select class="form-control" name="managerStatus" id="managerStatus">
                          <?php 
                          if($aManagersStatus){
                            foreach ($aManagersStatus as $key => $value) {
                              $selected = ($key == $managerStatus) ? 'selected' : '';
                              echo "<option value='$key' $selected >$value</option>";
                            }
                          } 
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-10 col-sm-10 col-xs-10">&nbsp;</div>

                </div> 
                <!-- end row -->

                <!-- row -->  
                  <div class="row" style="margin-top:1%;display:none" id='formValidationMessage'>
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="alert alert-error">
                          <?=FORM_VALIDATION_MESSAGE_ALERT?>
                        </div>
                      </div>
                  </div> 
                  <!-- end row -->

                <!-- row -->  
                <div class="row">

                  <div class="col-md-8 col-sm-8 col-xs-8">
                    <div class="form-group">
                      <div class="controls">
                        <button class="btn btn-success" name="btnSubmit" style="width:100px;margin-right:20px">Gravar</button>
                        <?=(isset($managerID)) ? "<button class='btn btn-danger' name='btnDelete' style='width:100px;margin-right:20px'>Excluir</button>":null; ?>
                        <button class="btn btn-info" name="btnBack" style="width:100px;margin-right:20px">Voltar</button>
                      </div>
                    </div>
                  </div>

                  
                </div> 
                <!-- end row -->

                  
                </form>
                </div>
              </div>
            </div>
          </div>

          <!-- END PAGE -->
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
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-inputmask/jquery.inputmask.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-autonumeric/autoNumeric.js" type="text/javascript"></script>
    <script src="assets/plugins/ios-switch/ios7-switch.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js" type="text/javascript"></script>
    <script src="assets/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.js" type="text/javascript"></script>
    <script src="assets/plugins/dropzone/dropzone.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="assets/js/form_elements.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->

    <!-- AUDIO PLAYER  -->
    <!--link rel="stylesheet" href="assets/dist/css/main.min.css">
    <script-- src="assets/dist/js/app.js"></script-->
    <!-- END AUDIO PLAYER  -->


    <script>
      $(document).ready(function() {
        
        $("button[name='btnDelete']").click(function(e){
          e.preventDefault();
          if(confirm('Deseja realmente excluir este/a Administrador/a ?')){
              $("input[name='action']").val('exc');
              $("form").submit();
            }else{
                return false;
            }
          
        });
        
        $("button[name='btnBack']").click(function(e){
          e.preventDefault();
          window.location.href = "<?=PREVIUS_PAGE?>";
        });

        $("button[name='btnSubmit']").click(function(e){
          e.preventDefault();
          
          let validate = formValidate();
          //alert(validate["errors"]);
          //alert(validate["warnings"]);

          if(validate["errors"]==0){
            if(validate["warnings"]>0){
              // show warnings
              showValidateResult();
              if(confirm('Existem pendências, deseja gravar na mesma ?')){
                // submit
                $("form").submit();
                return;
              }else{
                return false;
              } // endif confirm
            } // endif warnings
            else {
              // submit
              $("form").submit();
              return;
            }
            
          }else{
            //alert('aqui');
              // show errors
              showValidateResult();
              return;
          }
          
        });


        function formValidate(){
          let err = [];
          let warn = [];
          // validacoes

          if ($("input[name=managerName]").val() == "")  {
            err.push(['managerName', 'Informe o nome do/a Adminstrador/a']);
          }
          if ($("input[name=managerEmail]").val() == "")  {
            err.push(['managerEmail', 'Informe o Email do/a Adminstrador/a']);
          }
          if ($("input[name=managerFunction]").val() == "")  {
            warn.push(['managerFunction', 'Informe a Função/Cargo do/a Adminstrador/a']);
          }
          if ($("input[name=managerTlm]").val() == "")  {
            warn.push(['managerTlm', 'Informe o Telemóvel do/a Adminstrador/a']);
          }
          
          // end validacoes

          sessionStorage.setItem('errors', JSON.stringify(err));
          sessionStorage.setItem('warnings', JSON.stringify(warn));

          const results = {errors: err.length, warnings: warn.length};
          results['errors'] = err.length; 
          results['warnings'] = warn.length; 

          return results;
          
			} // end function formValidate

      function showValidateResult(){
        
          const parsedE = JSON.parse(sessionStorage.getItem('errors'));
          const parsedW = JSON.parse(sessionStorage.getItem('warnings'));

            // $('div.page-content').scrollTop(0);
            $("div.alert-dismissible").show("slow").delay(5000).hide("fast");

            // clean labels !
            $("div#formValidationMessage").hide();
            $("label[class~='error']").html('');

          //$("label[class~='error']").html(''); // clean labels !
          if(parsedE.length >0){
            $("div#formValidationMessage").show();
            parsedE.forEach((errors) => {
              var target = errors[0];
              var text = errors[1];
              $("label[id="+target+"]").html(text);
              let style = $("label[id="+target+"]").attr('style');
              $("label[id="+target+"]").removeAttr("style");
              $("label[id="+target+"]").attr("style", style + ";color:red;");
              
            });
          }

          // $('div.page-content').scrollTop(0);
          $("div.alert-dismissible").show("slow").delay(5000).hide("fast");
          // $("label[class~='warning']").html(''); // clean labels !
          if(parsedW.length >0){
            parsedW.forEach((warnings) => {
              var target = warnings[0];
              var text = warnings[1];
              $("label[id="+target+"]").html(text);
              let style = $("label[id="+target+"]").attr('style');
              $("label[id="+target+"]").removeAttr("style");
              $("label[id="+target+"]").attr("style", style + ";color:orange;");
              
            });
          }
          sessionStorage.clear();

        } // end function showValidateResult

      });
    </script>
    
  </body>
</html>