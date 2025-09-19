<?php
@session_start();
// echo '<pre>'.json_encode($_SESSION).'</pre>';
require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../src/Parameters.php';
require_once __DIR__. '/../src/Functions.php';
require_once __DIR__. '/../src/Tools/Translator.php';
include_once __DIR__. "/__session_verify.php";
ini_set("display_errors",0);
# error_reporting(E_ALL);

if($_SESSION['lang']) {
    $langCode = $_SESSION['lang'];
} else {
    $langCode = ($_SESSION[CONTAINER_NAME."_mLang"]) ? f_decode($_SESSION[CONTAINER_NAME."_mLang"]): 'en';
    $_SESSION['lang'] = $langCode;  
}
$dict = new Translator();

use Src\Models\VwSysNavs;

@define('PAGE_NAME', 'Items do Menu de Navegação');
@define('NEXT_PAGE', '_navs.frm');
@define('PREVIUS_PAGE', null);

include '__lstNavGroups.inc.php';
include '__lstNavSubGroups.inc.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title><?=BACKOFFICE_TITLE?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="alexandre.borba@gmail.com" name="author" />
    
    <!-- Favicon/x-icon 180X180 -->
    <link rel="shortcut icon" href="../images/favicons/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../images/favicons/favicon.ico" type="image/x-icon">

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
              <a href="__masterpage" class="dropdown-toggle active" data-toggle="">
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
                  <div class='grid-title-left'>
                    <h4><span class="bold" style="color:#02244F;"><?=PAGE_NAME?></span></h4>
                  </div>
                  <div class='grid-title-right'>
                    <button class="btn btn-danger" name="btnAdd" style="width:100px;">Novo/a</button>
                  </div>
                </div>
                <div class="grid-body ">
                  <table class="table table-striped" id="datalist">
                    <thead>
                      <tr>
                        <th style="text-align:center;width:5%">#</th>
                        <!-- <th style="text-align:center;width:25%">UUID</th> -->
                        <th style="text-align:left;width:20%">Grupo</th>
                        <th style="text-align:left;width:20%">SubGrupo</th>
                        <th style="text-align:left;width:15%">Nome Item</th>
                        <th style="text-align:left;width:15%">Link</th>
                        <th style="text-align:left;width:15%">seq</th>
                        <th style="text-align:center;width:7%">status</th>
                        <th style="text-align:center;width:7%">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    
                    $navs = (new VwSysNavs())->find("deleted_at IS NULL")->order("navGroupSeq ASC,navSubGroupSeq ASC,navSeq ASC")->fetch(true);
                    if($navs){
                        foreach($navs as $nav){
                    ?>

                    <tr class="odd gradeX">
                        <td style="text-align:center;vertical-align: middle;"><?=$nav->navID?></td>
                        <!-- 
                        <td style="text-align:center;vertical-align: middle;">
                          <a href="<?=NEXT_PAGE?>?ref=<?=f_encode($nav->navID)?>" ><?=$nav->navUUID?></a>
                        </td>
                        -->
                        <td style="text-align:left;vertical-align: middle;font-weight:normal"><?=$lstNavGroups[$nav->navGroupUUID]?></td>
                        <td style="text-align:left;vertical-align: middle;font-weight:normal"><?=$lstNavSubGroups[$nav->navSubGroupUUID]?></td>
                        <td style="text-align:left;vertical-align: middle;font-weight:bold"><?=$nav->navName?></td>
                        <td style="text-align:left;vertical-align: middle;font-weight:normal"><?=$nav->navUrl?></td>
                        <td style="text-align:left;vertical-align: middle;font-weight:normal"><?=$nav->navSeq?></td>
                        <td style="text-align:center;vertical-align: middle;">
                          <span style="padding:10px 30px 10px 30px;" class="label <?=$aNavsStatusLabel[$nav->navStatus]?>"><?=$aNavsStatus[$nav->navStatus]?></span>
                        </td>
                        <td class="center" style="text-align:center;vertical-align: middle;">
                            <a href="<?=NEXT_PAGE?>?ref=<?=f_encode($nav->navID)?>" class="btn btn-success" style="width:100px;">Editar</a>
                        </td>
                      </tr>

                    <?php
                        }
                    }
                    ?>
                    </tbody>
                  </table>
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
        document.location.href = "<?=NEXT_PAGE?>";
      });

      const table = $('#datalist');
      table.DataTable({
        order: [[4, 'asc']], // ← Coluna "seq", ordenação ascendente 
          "lengthMenu": [10, 25, 50, 75, 100],
          "responsive": true,
          "autoWidth": true,
          "stateSave" : true,
          "language": {
              "paginate": {
                  "last": "Ultima",
                  "first": "Primeira",
                  "next": "Próxima",
                  "previous": "Anterior"
              },
              "info": "A exibir _START_ a _END_ de _TOTAL_ registos",
              "infoEmpty": "A Exibir 0 a 0 de 0 registos",
              "infoFiltered": "(Filtrado de _MAX_ total registos)",
              "search": "Pesquisar na listagem Por : ",
              "zeroRecords": "Nenhum registo encontrado",
              "lengthMenu": "Exibir  _MENU_  registos por página",
              "loadingRecords": "A Carregar...",
              "processing": "A Processar...",
              "emptyTable": "Nenhum registo encontrado"
          }
      });

    });
  </script>
</html>