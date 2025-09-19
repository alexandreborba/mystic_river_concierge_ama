<?php
@session_start();
require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../src/Parameters.php';
require_once __DIR__. '/../src/Functions.php';
require_once __DIR__. '/../src/Tools/Translator.php';
include_once __DIR__. "/__session_verify.php";
ini_set('display_errors', 3);

use Ramsey\Uuid\Uuid;
use Src\Models\Spas;

@define('PAGE_NAME', 'SPA IMAGE');
@define('NEXT_PAGE', '_spas.sbm');
@define('PREVIUS_PAGE', '_spas.lst');

$action = 'ins';
$newUUID = Uuid::uuid4();
$spaUUID = $newUUID;
$spaDate = f_date();
$spaStatus = 1;

$id = ($_GET['ref']) ? f_decode(filter_var(trim($_GET['ref']), FILTER_SANITIZE_STRING)) : null;

if ($id) {
    $action = 'upd';
    $spa = (new Spas())->findById($id);
    foreach ($spa->Data() as $field => $value) {
        ${$field} = ($field !== '') ? trim($value) : null;
    }
    $spaUUID = (empty($spaUUID)) ? $newUUID : $spaUUID;
}

#f_dump($lstMenuTypes);

?>
<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="ie ie6 lte9 lte8 lte7"> <![endif]-->
<!--[if IE 7]>     <html class="ie ie7 lte9 lte8 lte7"> <![endif]-->
<!--[if IE 8]>     <html class="ie ie8 lte9 lte8"> <![endif]-->
<!--[if IE 9]>     <html class="ie ie9 lte9"> <![endif]-->
<!--[if gt IE 9]>  <html> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
  <!--<![endif]-->
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title><?php echo BACKOFFICE_TITLE; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="alexandre.borba@gmail.com" name="author" />
    <meta content="pedro.neves@mysticinvest.com" name="author" />
    <meta content="" name="description" />
    
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
    <link href="webarch/css/webarch.css?<=f_dateimagerenew()?>" rel="stylesheet" type="text/css" />
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
          <?php include_once '__toggler.php'; ?>
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
          <?php require_once '__sidebar.php'; ?>
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
          
          

          <!-- BEGIN BASIC FORM ELEMENTS-->
          <div class="row">
            <div class="col-md-12">
              <div class="grid simple">
                <div class="grid-title no-border" style="padding:10px 0px 10px 20px">
                  <h3><span class="semi-bold" style="color:#02244F"><?php echo PAGE_NAME.' '.f_upper($actionsTitles[$action]); ?></span></h3>
                  <hr>
                </div>
                
                <div class="grid-body no-border">
                  
                <form name="form" action="<?php echo NEXT_PAGE; ?>" method="post" enctype="multipart/form-data">
                  <input type="hidden" id="action" name="action" value="<?=$action; ?>">
                  <input type="hidden" id="shipCode" name="shipCode" value="<?=shipCode; ?>">
                  <input type="hidden" id="operCode" name="operCode" value="<?=operCode; ?>">
                  <input type="hidden" id="spaUUID"   name="spaUUID"   value="<?=$spaUUID; ?>">
                  <?php
                  if ($action = 'upd') {
                      echo ($spaID) ? chr(10).chr(9).chr(9).chr(9).chr(9)."<input type='hidden' id='spaID' name='spaID' value='{$spaID}'>".chr(10) : null;
                      echo "<input type='hidden' id='spaFile' name='spaFile' value='{$spaFile}'>".chr(10);
                      echo ($spaFileOriginal) ? chr(9).chr(9).chr(9).chr(9)."<input type='hidden' id='spaFileOriginal' name='spaFileOriginal' value='{$spaFileOriginal}'>".chr(10) : null;
                  }// end if
?>
                  <!-- row -->  
                  <div class="row">

                    <div class="col-md-1 col-sm-1 col-xs-1">
                      <div class="form-group">
                        <label class="form-label">ID</label>
                        <div class="controls">
                          <p><?=$spaID; ?></p>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-4 col-xs-4">
                      <div class="form-group">                        
                        <label class="form-label">UUID</label>
                        <div class="controls">
                        <p style='font-family:roboto;color:#dadada;font-weight:bold'><?=$spaUUID;?></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-5">
                    </div>
                  </div> 
                  <!-- end row -->
                  <hr>

                  <!-- row -->  
                  <div class="row" style="margin-top:1%">

                    <div class="col-md-2 col-sm-2 col-xs-2">
                      <div class="form-group">
                        <label class="form-label">Date</label>
                        <span class="help"></span>
                        <div class="controls">
                          <input type="date" id="spaDate" name="spaDate"  class="form-control" style="font-weight:bold"  value="<?=$spaDate;?>">
                          <label id="spaDate" style="padding-left:5px;font-size:12px" class="form-label error"></label>
                        </div>
                      </div>
                    </div>

                  </div> 
                  <!-- end row -->
                  <!-- row -->  
                  <div class="row" style="margin-top:1%">

                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <div class="form-group">
                        <label class="form-label">Spa Name</label>
                        <span class="help"></span>
                        <div class="controls">
                          <input type="text" id="spaName" name="spaName"  class="form-control" style="font-weight:bold"  value="<?=$spaName; ?>">
                          <label id="spaName" style="padding-left:5px;font-size:12px" class="form-label error"></label>
                        </div>
                      </div>
                    </div>

                  </div> 
                  <!-- end row -->

                  <?php 
                      if($spaFile){
                  ?>
                  <!-- row -->  
                  <div class="row" style="margin-top:1%">
                    <div class="col-md-10 col-sm-10 col-xs-10">
                     <label class="form-label">File <?=$spaFile;?> Preview</label>
                        <div class="controls" style="text-align:center">
                          <img src="../<?=CONCIERGE_SPAS_IMAGE_FOLDER.DS.$spaFile.'?'.f_dateimagerenew();?>" style="width:90%; border:1px dotted #eaeaea; padding:5px; margin:5px;">
                        </div>
                        
                      </div>
                    </div>
                    
                    <!-- end row -->
                    <?php 
                      } // end if
                    ?>

                     <!-- row -->  
                  <div class="row" style="margin-top:2%">    

                    <div class="col-md-10 col-sm-10 col-xs-10">
                      <div class="form-group">
                      <label class="form-label">New Image File [HD 1080p 1920x1080px is the recommended size ]</label><br>
                      <span class="help">(png, jpg, jpeg and webp)</span>
                        <div class="controls">
                          <input type="file" id="spaFileNew" name="spaFileNew"  class="form-control" accept="image/png,image/jpg,image/jpeg,image/webp" c>
                          <label id="spaFileNew" style="padding-left:5px;font-size:12px" class="form-label error"></label>
                        </div>
                      </div>
                    </div>

                    
                  </div>
                    
                  <!-- end row -->
                  <?php     
                      if($spaFile && file_exists('../'.CONCIERGE_SPAS_IMAGE_FOLDER.DS.$spaFile)){
                  ?>
                  <!-- row -->  
                  <div class="row" style="margin-top:1%">

                  <div class="col-md-2 col-sm-2 col-xs-2">
                    <div class="form-group">
                      <label class="form-label">Filesize</label>
                      <div class="controls">
                        <p style='color:#0969da'><?=($spaFileSize) ? f_filesSizeFormatShort($spaFileSize) : null ; ?></p>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-2 col-sm-2 col-xs-2">
                    <div class="form-group">
                      <label class="form-label">Dimensions</label>
                      <div class="controls">
                        <p style='color:#0969da'><?=$spaFileDimensions; ?></p>
                      </div>
                    </div>
                  </div>

                  </div>
                  <!-- end row -->
                  <?php     
                      } // end if
                  ?>
                
                  <!-- row -->  
                  <div class="row" style="margin-top:1%">

                    <div class="col-md-2 col-sm-2 col-xs-2">
                      <div class="form-group">
                        <label class="form-label">Status</label>
                        <span class="help"></span>
                        <div class="controls">
                          <select class="form-control" name="spaStatus" id="spaStatus">
                          <?php
                          if ($aSpasStatus) {
                            foreach ($aSpasStatus as $key => $value) {
                              $selected = ($key == $spaStatus) ? 'selected' : '';
                              echo "<option value='$key' $selected >$value</option>";
                            }
                          } // end iff
                          ?>
                          </select>
                        </div>
                      </div>
                    </div>

                  </div> 
                  <!-- end row -->

                  <hr>
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
                  <div class="row" style="margin-top:2%">

                    <div class="col-md-8 col-sm-8 col-xs-8">
                      <div class="form-group">
                        <div class="controls">
                          <button class="btn btn-info" name="btnSave" style="width:100px;margin-right:20px">Save</button>
                          <?php echo (isset($spaID)) ? "<button class='btn btn-danger' name='btnDelete' style='width:100px;margin-right:20px'>Delete</button>" : null; ?>
                          <button class="btn btn-info" name="btnBack" style="width:100px;margin-right:20px">Back</button>
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
          if(confirm('Do you really want to delete this Daily Program ?')){
              $("input[name='action']").val('exc');
              $("form").submit();
            }else{
                return false;
            }
          
        });
        
        $("button[name='btnBack']").click(function(e){
          e.preventDefault();
          // window.location.href = "<?php echo PREVIUS_PAGE; ?>";
          window.location.replace("<?php echo PREVIUS_PAGE; ?>");
        });

        $("button[name='btnSave']").click(function(e){
          e.preventDefault();
          
          let validate = formValidate();
          //alert(validate["errors"]);
          //alert(validate["warnings"]);
          
          if(validate["errors"]==0){
            if(validate["warnings"]>0){
              // show warnings
              showValidateResult();
              if(confirm('There are pending items, do you want to save them? ?')){
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
              // show errors
              showValidateResult();
              return;
          }
          
        });


        function formValidate(){
          let err = [];
          let warn = [];
          // validacoes
        
          if ($("input[name=dmDate]").val() == "")  {
            err.push(['spaDate', 'Enter the Date']);
          }
          
          if($("input[name=action]").val() == "ins" && $("input[name=spaFile]").val() == ""){
            if ($("input[name=spaFileNew]").val() == "")  {
              err.push(['spaFileNew', 'Select the file']);
            }
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