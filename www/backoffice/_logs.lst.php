<?php
@session_start();
// echo '<pre>'.json_encode($_SESSION).'</pre>';
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

use Src\Models\SysLogs;
use Src\Models\SysManagers;

$managers = (new SysManagers())->find()->fetch(true);
if($managers){
    foreach($managers as $manager){
        $lstManagers[$manager->managerUUID] = $manager->managerName;
    }
}

?>

<!DOCTYPE html>
<html>
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
    <link href="assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/jquery-datatable/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen" />
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
          <?php require_once "__top-nav.php"; ?>
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
    <div class="page-container row-fluid">

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
        
        <div class="clearfix"></div>
        <div class="content">

          <div class="page-title">
            <h3> <span class="semi-bold">Listagem</span></h3>
          </div>

          <?php if($_SESSION[CONTAINER_NAME."_messages_form"]["text"]) { ?>
            <div class="alert alert-<?=$_SESSION[CONTAINER_NAME."_messages_form"]["tp"]?> ">
              <button class="close" data-dismiss="alert"></button>
              <?=$_SESSION[CONTAINER_NAME."_messages_form"]["text"]?>
              <?php unset($_SESSION[CONTAINER_NAME."_messages_form"]); ?>
            </div>
          <?php } // end if ?>

          <!-- DATATABLE -->
          <div class="row-fluid">
            <div class="span12">
              <div class="grid simple ">
                <div class="grid-title" style="padding:25px 10px 10px 20px;">
                  <h4><span class="bold" style="color:#02244F;">LOGS</span></h4>
                  
                </div>
                <div class="grid-body ">
                  <?php 
                      $logs = (new SysLogs())->find("deleted_at IS NULL")->order('logDateTime DESC')->fetch(true);
                      if($logs){
                  ?>
                  <table class="table table-striped" id="datalist">
                    <thead>
                      <tr>
                        <th style="text-align:center;width:5%">#</th>
                        <!-- <th style="text-align:center;width:22%">UUID</th> -->
                        <th style="text-align:left;width:10%">Data/Hora</th>
                        <th style="text-align:left;width:10%">Sequencial</th>
                        <th style="text-align:left;width:15%">Admin</th>
                        <th style="text-align:left;width:9%">Result</th>
                        <th style="text-align:left;width:15%">Page</th>
                        <th style="text-align:left;width:10%">Action</th>
                        <th style="text-align:center;width:7%">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                        foreach($logs as $log){
                    ?>

                    <tr class="odd gradeX">
                        <td style="text-align:center;vertical-align: middle;"><?=$log->logID?></td>
                        <!-- <td style="text-align:center;vertical-align: middle;">
                          <a href="_logs.vire?ref=<?=f_encode($log->logID)?>" ><?=$log->logUUID?></a>
                        </td> -->
                        <td style="text-align:left;vertical-align: middle;font-weight:bold"><?=f_ajustDateTime($log->logDateTime)?></td>
                        <td style="text-align:left;vertical-align: middle;font-weight:bold"><?=str_replace(":","",(str_replace(" ","",(str_replace("-","",$log->logDateTime)))))?></td>
                        <td style="text-align:left;vertical-align: middle;font-weight:normal"><?=$lstManagers[$log->managerUUID]?></td>
                        <td style="text-align:left;vertical-align: middle;font-weight:normal"><?=$log->logActionResult?></td>
                        <td style="text-align:left;vertical-align: middle;font-weight:normal"><?=$log->logPage?></td>
                        <td style="text-align:left;vertical-align: middle;font-weight:normal"><?=$log->logAction?></td>
                        
                        <td class="center" style="text-align:center;vertical-align: middle;">
                            <a href="_logs.view?ref=<?=f_encode($log->logID)?>" class="btn btn-success" style="width:100px;">Ver</a>
                        </td>
                      </tr>

                    <?php
                        } // end foreach
                      } else {
                        echo "<tr><td colspan='6' style='text-align:center;'>No logs found</td></tr>";
                    ?>
                    </tbody>
                  </table>
                  <?php } // end if ?>
                </div>
              </div>
            </div>
          </div>
          <!-- END DATATABLE -->

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
    <script src="assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-datatable/1.13.6/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
    <script type="text/javascript" src="assets/plugins/datatables-responsive/js/lodash.min.js"></script>
    <!-- END PAGE LEVEL JS INIT -->
    <script src="assets/js/datatables.js" type="text/javascript"></script>
    <!-- END JAVASCRIPTS -->
  </body>
  <script>
    $(document).ready(function () {
      
      $("button[name='btnAdd']").click(function(e){
        e.preventDefault();
        document.location.href = "_logs.view";
      });

    });
  </script>
</html>