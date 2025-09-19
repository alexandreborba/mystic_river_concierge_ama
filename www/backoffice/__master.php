<?php
@session_start();
require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../src/Parameters.php';
require_once __DIR__. '/../src/Functions.php';
require_once __DIR__. '/../src/Tools/Translator.php';
include_once __DIR__. "/__session_verify.php";
ini_set("display_errors", 0);
#error_reporting(E_ALL);

    $page = ($_GET["p"]) ? f_decode($_GET["p"]) : "dashboard.view";

?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title><?=BACKOFFICE_TITLE?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content=""  />
    <meta name="author" content=""  />

    <!-- MESSAGES -->
    <link href="assets/plugins/jquery-notifications/css/messenger.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/jquery-notifications/css/messenger-theme-flat.css" rel="stylesheet" type="text/css" media="screen" />
    <!-- end MESSAGES -->

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
        
        <?php 
          #echo "<!-- {$page} -->";
          include_once "_{$page}.php"; 
          ?>
      </div>

    </div>
    <!-- END CONTAINER -->

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

    <!-- MESSAGES -->
    <script src="assets/plugins/jquery-notifications/js/messenger.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-notifications/js/messenger-theme-flat.js" type="text/javascript"></script>
    <!-- end MESSAGES -->

    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="webarch/js/webarch.js" type="text/javascript"></script>
    <script src="assets/js/chat.js" type="text/javascript"></script>
    <!-- END CORE TEMPLATE JS -->
  </body>
</html>