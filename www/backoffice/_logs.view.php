<?php
@session_start();
require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../src/Parameters.php';
require_once __DIR__. '/../src/Functions.php';
require_once __DIR__. '/../src/Tools/Translator.php';
include_once __DIR__. "/__session_verify.php";
ini_set("display_errors", 0);
#error_reporting(E_ALL);

use Src\Models\SysLogs;
use Src\Models\SysManagers;

$managers = (new SysManagers())->find()->fetch(true);
if($managers){
    foreach($managers as $manager){
        $lstManagers[$manager->managerUUID] = $manager->managerName;
    }
}

$logID = ($_GET["ref"]) ? f_decode(filter_var(trim($_GET["ref"]), FILTER_SANITIZE_STRING)) : null;

$action = 'view';
$log = (new SysLogs())->findById($logID);
foreach ($log->Data() as $field => $value) {
    ${$field} = ($field !== "") ? trim($value) : null;
}
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
    <meta content="" name="description" />
    <meta content="" name="author" />
    
    <!-- Favicon/x-icon 180X180 -->
    <!-- <link rel="shortcut icon" href="../images/favicons/favicon.ico" type="image/x-icon">-->
        <!-- <link rel="icon" href="../images/favicons/favicon.ico" type="image/x-icon"> -->


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
                  <h3><span class="semi-bold" style="color:#02244F">Log</span></h3>
                  <hr>
                </div>
                
                <div class="grid-body no-border">

                    <form name="form" action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="action" name="action" value="<?=$action?>">

                    <!-- row -->  
                    <div class="row">

                        <div class="col-md-1 col-sm-1 col-xs-1">
                            <div class="form-group">
                            <label class="form-label">ID</label>
                            <div class="controls" style="color:#02244F">
                                <p><?=$logID?></p>
                            </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <div class="form-group">                        
                            <label class="form-label">UUID</label>
                            <div class="controls" style="color:#02244F">
                                <p><?=$logUUID?></p>
                            </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <div class="form-group">                        
                            <label class="form-label">Data/Hora</label>
                            <div class="controls" style="color:#02244F">
                                <p><?=f_ajustDateTime($logDateTime)?></p>
                            </div>
                            </div>
                        </div>

                    </div> 
                    <!-- end row -->

                    <hr>

                    <!-- row -->  
                    <div class="row">

                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">
                            <label class="form-label">Admin</label>
                            <div class="controls" style="color:#02244F">
                                <p><strong><?=$lstManagers[$managerUUID]?></strong></p>
                            </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">                        
                            <label class="form-label">IP</label>
                            <div class="controls" style="color:#02244F">
                                <p><?=$logIP?></p>
                            </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">                        
                            <label class="form-label">User</label>
                            <div class="controls" style="color:#02244F">
                                <p><?=$userID?></p>
                            </div>
                            </div>
                        </div>

                    </div> 
                    <!-- end row -->

                    <!-- row -->  
                    <div class="row">

                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">                        
                            <label class="form-label">Pagina</label>
                            <div class="controls" style="color:#02244F">
                                <p><strong><?=$logPage?></strong></p>
                            </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">                        
                            <label class="form-label">Ação</label>
                            <div class="controls" style="color:#02244F">
                                <p><strong><?=$logAction?></strong></p>
                            </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">
                            <label class="form-label">Plataforma</label>
                            <div class="controls" style="color:#02244F">
                                <p><strong><?=$logPlataform?></strong></p>
                            </div>
                            </div>
                        </div>

                    </div> 
                    <!-- end row -->

                    <!-- row -->  
                    <div class="row">

                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <div class="form-group">
                            <label class="form-label">Resultado da Ação</label>
                            <div class="controls" style="color:#02244F">
                                <p><?=$logActionResult?></p>
                            </div>
                            </div>
                        </div>

                        </div> 
                    <!-- end row -->

                    <?php if($logData) { ?>
                    <!-- row -->  
                    <div class="row">

                        <div class="col-md-10 col-sm-10 col-xs-10">
                            <div class="form-group">                        
                            <label class="form-label">Dados</label>
                            <div class="controls" style="color:#02244F">
                                <?php
                                $logData =  htmlspecialchars($logData);
                                $logData =  html_entity_decode($logData);
                                $logData = str_replace(",",",<br>",$logData);
                                $logData = str_replace("{","{<br>",$logData);
                                $logData = str_replace("}","<br>}",$logData);
                                ?>
                                <code><?=$logData?></code>
                            </div>
                            </div>
                        </div>

                    </div> 
                    <!-- end row -->
                    <?php } // end if ?>

                    <?php if($logDataFile) { ?>
                    <!-- row -->  
                    <div class="row">

                      <div class="col-md-10 col-sm-10 col-xs-10">
                            <div class="form-group">                        
                            <label class="form-label">Dados File</label>
                            <div class="controls" style="color:#02244F">
                                <?php
                                $logDataFile =  htmlspecialchars($logDataFile);
                                $logDataFile =  html_entity_decode($logDataFile);
                                $logDataFile = str_replace(",",",<br>",$logDataFile);
                                $logDataFile = str_replace("{","{<br>",$logDataFile);
                                $logDataFile = str_replace("}","<br>}",$logDataFile);
                                ?>
                                <code><?=$logDataFile?></code>
                            </div>
                            </div>
                        </div>

                    </div> 
                    <!-- end row -->
                    <?php } // end if ?>

                    <?php if($logDataError) { ?>
                    <!-- row -->  
                    <div class="row">

                      <div class="col-md-10 col-sm-10 col-xs-10">
                            <div class="form-group">                        
                            <label class="form-label">Dados Error</label>
                            <div class="controls" style="color:#02244F">
                                <?php
                                $logDataError =  htmlspecialchars($logDataError);
                                $logDataError =  html_entity_decode($logDataError);
                                $logDataError = str_replace(",",",<br>",$logDataError);
                                $logDataError = str_replace("{","{<br>",$logDataError);
                                $logDataError = str_replace("}","<br>}",$logDataError);
                                ?>
                                <code><?=$logDataError?></code>
                            </div>
                            </div>
                        </div>

                    </div> 
                    <!-- end row -->
                    <?php } // end if ?>

                    <!-- row -->  
                    <div class="row">

                        <div class="col-md-8 col-sm-8 col-xs-8">
                        <div class="form-group">
                            <div class="controls">
                            <button class="btn btn-info" name="btnBack" style="width:100px;margin-right:20px">Back</button>
                            </div>
                        </div>
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            &nbsp;
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
        
        
        $("button[name='btnBack']").click(function(e){
          e.preventDefault();
          window.location.href = "_logs.lst";
        });

      });
    </script>
    
  </body>
</html>