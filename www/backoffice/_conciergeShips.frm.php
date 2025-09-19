<?php
@session_start();
require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../src/Parameters.php';
require_once __DIR__. '/../src/Functions.php';
require_once __DIR__. '/../src/Tools/Translator.php';
include_once __DIR__. "/__session_verify.php";
ini_set("display_errors", 0);
// error_reporting(E_ALL);

use Ramsey\Uuid\Uuid;
use Src\Models\ConciergeShips;

@define('PAGE_NAME', 'CONFIG CONCIERGE');
@define('NEXT_PAGE', '_conciergeShips.sbm');
@define('PREVIUS_PAGE', '_conciergeShips.lst');

$action = 'ins';
$newUUID = Uuid::uuid4();
$shipUUID = $newUUID;
$shipStatus = 1;
$shipMenuPosition = 'T';

$id = ($_GET['ref']) ? f_decode(filter_var(trim($_GET['ref']), FILTER_SANITIZE_STRING)) : null;

if ($id) {
    $action = 'upd';
    $ship = (new ConciergeShips())->findById($id);
    foreach ($ship->Data() as $field => $value) {
        ${$field} = ($field !== '') ? trim($value) : null;
    }
    $shipUUID = (empty($shipUUID)) ? $newUUID : $shipUUID;
}
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
    <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/bootstrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="assets/plugins/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
    <link href="webarch/css/webarch.css?<=f_dateimagerenew()?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="assets/dist/css/audio-player.min.css">
  </head>
  <body class="">
    <div class="header navbar navbar-inverse ">
      <div class="navbar-inner">
        <div class="header-seperation">
          <ul class="nav pull-left notifcation-center visible-xs visible-sm">
            <li class="dropdown">
              <a href="#main-menu" data-webarch="toggle-left-side">
                <i class="material-icons">menu</i>
              </a>
            </li>
          </ul>
          <ul class="nav pull-right notifcation-center">
            <li class="dropdown hidden-xs hidden-sm">
              <a href="__master" class="dropdown-toggle active" data-toggle="">
                <i class="material-icons">home</i>
              </a>
            </li>
          </ul>
        </div>
        <div class="header-quick-nav">
          <div class="pull-left">
            <ul class="nav quick-section">
              <li class="quicklinks">
                <a href="#" class="" id="layout-condensed-toggle">
                  <i class="material-icons">menu</i>
                </a>
              </li>
            </ul>
          </div>
          <?php include_once '__toggler.php'; ?>
        </div>
      </div>
    </div>
    <div class="page-container row">
      <div class="page-sidebar " id="main-menu">
        <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
          <?php require_once '__sidebar.php'; ?>
        </div>
      </div>
      <a href="#" class="scrollup">Scroll</a>
      <div class="footer-widget" style="text-align:center;color:#696969">
        <?=(shipCode) ? shipCode.' | '.shipName.BR : '';?>
        <?=f_ajustDateTime(f_datetime());?>
      </div>
      <div class="page-content">
        <div class="content">
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
                  <input type="hidden" id="shipUUID" name="shipUUID" value="<?=$shipUUID; ?>">
                  <input type="hidden" id="shipMenuPosition" name="shipMenuPosition" value="<?=$shipMenuPosition; ?>">
                  <?php
                  if ($action == 'upd') {
                      echo ($shipID) ? "\n\t\t\t\t\t\t<input type='hidden' id='shipID' name='shipID' value='{$shipID}'>\n" : null;
                      echo "<input type='hidden' id='shipFileLogo' name='shipFileLogo' value='{$shipFileLogo}'>\n";
                      echo "<input type='hidden' id='shipFileImage' name='shipFileImage' value='{$shipFileImage}'>\n";
                      echo "<input type='hidden' id='shipConciergeNoContentImage' name='shipConciergeNoContentImage' value='{$shipConciergeNoContentImage}'>\n";
                      echo "<input type='hidden' id='shipRestaurantNoContentImage' name='shipRestaurantNoContentImage' value='{$shipRestaurantNoContentImage}'>\n";
                  }
                  ?>
                  <div class="row">
                    <div class="col-md-1 col-sm-1 col-xs-1">
                      <div class="form-group">
                        <label class="form-label">ID</label>
                        <div class="controls">
                          <p><?=$shipID; ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                      <div class="form-group">
                        <label class="form-label">UUID</label>
                        <div class="controls">
                        <p style='font-family:roboto;color:#dadada;font-weight:bold'><?=$shipUUID;?></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                      <div class="form-group">
                        <label class="form-label">ShipCode</label>
                        <div class="controls">
                        <p style='font-family:roboto;color:#dadada;font-weight:bold'><?=shipCode;?></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                      <div class="form-group">
                        <label class="form-label">OperCode</label>
                        <div class="controls">
                        <p style='font-family:roboto;color:#dadada;font-weight:bold'><?=operCode;?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr>

                  <div class="row" style="margin-top:1%">
                    <div class="col-md-4 col-sm-4 col-xs-4">
                      <div class="form-group">
                        <label class="form-label">Ship Name</label>
                        <div class="controls">
                          <input type="text" id="shipName" name="shipName"  class="form-control" style="font-weight:bold"  value="<?=$shipName;?>">
                          <label id="shipName" style="padding-left:5px;font-size:12px" class="form-label error"></label>
                        </div>
                      </div>
                    </div>
                  </div>

                <?php if(SHOW_CONCIERGE): ?>
                <hr>
                <h4 style="color:#0969da;font-weight:bold">Logo Home Page</h4>

                <!-- LOGO: input + (placeholder quando não há imagem antiga) -->
                <div class="row" style="margin-top:1%">
                  <div class="col-md-10 col-sm-10 col-xs-10">
                    <div class="form-group">
                      <label class="form-label">New File Concierge Logo [ <font style='color:red'>300x40px</font> is the recommended size ]</label><br>
                      <span class="help">(png, jpg, jpeg and webp)</span>
                      <div class="controls">
                        <input type="file" id="shipFileLogoNew" name="shipFileLogoNew"  class="form-control" accept="image/png,image/jpg,image/jpeg,image/webp">
                        <label id="shipFileLogoNew" style="padding-left:5px;font-size:12px" class="form-label error"></label>

                        <?php if(!$shipFileLogo || !file_exists('../'.CONCIERGE_SHIP_IMAGE_FOLDER.DS.$shipFileLogo)): ?>
                        <div style="text-align:left">
                          <img name='shipFileLogoPreview' src="" style="width:35%; border:1px dotted #eaeaea; padding:5px; margin:5px; display:none;">
                        </div>
                        <p name='shipFileLogoSize' style='color:#0969da; display:none;'></p>
                        <p name='shipFileLogoDimensions' style='color:#0969da; display:none;'></p>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>

                  <?php 
                    if($shipFileLogo && file_exists('../'.CONCIERGE_SHIP_IMAGE_FOLDER.DS.$shipFileLogo)){
                  ?>
                  <div class="row" style="margin-top:1%">
                    <div class="col-md-10 col-sm-10 col-xs-10">
                      <label class="form-label" style="color:#0969da">File Concierge Logo [ <i style="color:#696969"><?=$shipFileLogo;?></i> ]</label>
                      <div class="controls" style="text-align:left">
                        <img name='shipFileLogoPreview' src="../<?=CONCIERGE_SHIP_IMAGE_FOLDER.DS.$shipFileLogo.'?'.f_dateimagerenew();?>" style="width:500px; border:1px dotted #eaeaea; padding:5px; margin:5px;">
                      </div>
                    </div>
                  </div>
                  <div class="row" style="margin-top:1%">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                      <div class="form-group">
                        <label class="form-label">Filesize</label>
                        <div class="controls">
                          <p name='shipFileLogoSize' style='color:#0969da'><?=($shipFileLogoSize) ? f_filesSizeFormatShort($shipFileLogoSize) : null ; ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                      <div class="form-group">
                        <label class="form-label">Dimensions</label>
                        <div class="controls">
                          <p name='shipFileLogoDimensions' style='color:#0969da'><?=$shipFileLogoDimensions; ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>

                  <hr>
                  <h4 style="color:#0969da;font-weight:bold">Concierge Content</h4>
                  <br>
                  <h4 style="color:#0b54a8;font-weight:bold"> > Home File</h4>

                  <!-- HOME IMAGE: input + placeholder quando necessário -->
                  <div class="row" style="margin-top:1%">
                    <div class="col-md-10 col-sm-10 col-xs-10">
                      <div class="form-group">
                        <label class="form-label">New Concierge Home Image File [ <font style='color:red'>1920x1050px</font> is the recommended size ]</label><br>
                        <span class="help">(png, jpg, jpeg and webp)</span>
                        <div class="controls">
                          <input type="file" id="shipFileImageNew" name="shipFileImageNew"  class="form-control" accept="image/png,image/jpg,image/jpeg,image/webp">
                          <label id="shipFileImageNew" style="padding-left:5px;font-size:12px" class="form-label error"></label>

                          <?php if(!$shipFileImage || !file_exists('../'.CONCIERGE_SHIP_IMAGE_FOLDER.DS.$shipFileImage)): ?>
                          <div style="text-align:left">
                            <img name='shipFileImagePreview' src="" style="width:70%; border:1px dotted #eaeaea; padding:1px; margin:5px; display:none;">
                          </div>
                          <p name='shipFileImageSize' style='color:#0969da; display:none;'></p>
                          <p name='shipFileImageDimensions' style='color:#0969da; display:none;'></p>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <?php 
                    if($shipFileImage && file_exists('../'.CONCIERGE_SHIP_IMAGE_FOLDER.DS.$shipFileImage)){
                  ?>
                  <div class="row" style="margin-top:1%">
                    <div class="col-md-10 col-sm-10 col-xs-10">
                      <label class="form-label" style="color:#0969da">File Concierge Home Preview [ <i style="color:#696969"><?=$shipFileImage;?></i> ]</label>
                      <div class="controls" style="text-align:left">
                        <img name='shipFileImagePreview' src="../<?=CONCIERGE_SHIP_IMAGE_FOLDER.DS.$shipFileImage.'?'.f_dateimagerenew();?>" style="width:70%; border:1px dotted #eaeaea; padding:1px; margin:5px;">
                      </div>
                    </div>
                  </div>
                  <div class="row" style="margin-top:1%">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                      <div class="form-group">
                        <label class="form-label">Filesize</label>
                        <div class="controls">
                          <p name='shipFileImageSize' style='color:#0969da'><?=($shipFileImageSize) ? f_filesSizeFormatShort($shipFileImageSize) : null ; ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                      <div class="form-group">
                        <label class="form-label">Dimensions</label>
                        <div class="controls">
                          <p name='shipFileImageDimensions' style='color:#0969da'><?=$shipFileImageDimensions; ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>

                  <hr>
                  <h4 style="color:#0b54a8;font-weight:bold"> > Concierge NO Content</h4>

                  <!-- NO CONTENT CONCIERGE -->
                  <div class="row" style="margin-top:1%">
                    <div class="col-md-10 col-sm-10 col-xs-10">
                      <div class="form-group">
                        <label class="form-label">New Concierge NoContentFile [ <font style='color:red'>1920x1050px</font> is the recommended size ]</label><br>
                        <span class="help">(png, jpg, jpeg and webp)</span>
                        <div class="controls">
                          <input type="file" id="shipConciergeNoContentImageNew" name="shipConciergeNoContentImageNew"  class="form-control" accept="image/png,image/jpg,image/jpeg,image/webp">
                          <label id="shipConciergeNoContentImageNew" style="padding-left:5px;font-size:12px" class="form-label error"></label>

                          <?php if(!$shipConciergeNoContentImage || !file_exists('../'.CONCIERGE_SHIP_IMAGE_FOLDER.DS.$shipConciergeNoContentImage)): ?>
                          <div style="text-align:left">
                            <img name='shipConciergeNoContentImagePreview' src="" style="width:70%; border:1px dotted #eaeaea; padding:1px; margin:5px; display:none;">
                          </div>
                          <p name='shipConciergeNoContentImageSize' style='color:#0969da; display:none;'></p>
                          <p name='shipConciergeNoContentImageDimensions' style='color:#0969da; display:none;'></p>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <?php 
                    if($shipConciergeNoContentImage && file_exists('../'.CONCIERGE_SHIP_IMAGE_FOLDER.DS.$shipConciergeNoContentImage)){
                  ?>
                  <div class="row" style="margin-top:1%">
                    <div class="col-md-10 col-sm-10 col-xs-10">
                      <label class="form-label" style="color:#0969da">File No Content Concierge Preview [ <i style="color:#696969"><?=$shipConciergeNoContentImage;?></i> ]</label>
                      <div class="controls" style="text-align:left">
                        <img name='shipConciergeNoContentImagePreview' src="../<?=CONCIERGE_SHIP_IMAGE_FOLDER.DS.$shipConciergeNoContentImage.'?'.f_dateimagerenew();?>" style="width:70%; border:1px dotted #eaeaea; padding:1px; margin:5px;">
                      </div>
                    </div>
                  </div>
                  <div class="row" style="margin-top:1%">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                      <div class="form-group">
                        <label class="form-label">Filesize</label>
                        <div class="controls">
                          <p name='shipConciergeNoContentImageSize' style='color:#0969da'><?=($shipConciergeNoContentImageSize) ? f_filesSizeFormatShort($shipConciergeNoContentImageSize) : null ; ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                      <div class="form-group">
                        <label class="form-label">Dimensions</label>
                        <div class="controls">
                          <p name='shipConciergeNoContentImageDimensions' style='color:#0969da'><?=$shipConciergeNoContentImageDimensions; ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                  <?php endif; // SHOW_CONCIERGE ?>

                  <hr>
                  <h4 style="color:#0969da;font-weight:bold">Menu Restaurant Content</h4>
                  <h4 style="color:#0b54a8;font-weight:bold"> > No Content Image </h4>

                  <!-- RESTAURANT NO CONTENT -->
                  <div class="row" style="margin-top:1%">
                    <div class="col-md-10 col-sm-10 col-xs-10">
                      <div class="form-group">
                        <label class="form-label">New Image Restaurant NoContent File [ <font style='color:red'>1920x1050px</font> is the recommended size ]</label><br>
                        <span class="help">( attention ! png only! )</span>
                        <div class="controls">
                          <input type="file" id="shipRestaurantNoContentImageNew" name="shipRestaurantNoContentImageNew"  class="form-control" accept="image/png">
                          <label id="shipRestaurantNoContentImageNew" style="padding-left:5px;font-size:12px" class="form-label error"></label>

                          <?php if(!$shipRestaurantNoContentImage || !file_exists('../'.CONCIERGE_SHIP_IMAGE_FOLDER.DS.$shipRestaurantNoContentImage)): ?>
                          <div style="text-align:left">
                            <img name='shipRestaurantNoContentImagePreview' src="" style="width:35%; border:1px dotted #eaeaea; padding:5px; margin:5px; display:none;">
                          </div>
                          <p name='shipRestaurantNoContentImageSize' style='color:#0969da; display:none;'></p>
                          <p name='shipRestaurantNoContentImageDimensions' style='color:#0969da; display:none;'></p>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <?php 
                    if($shipRestaurantNoContentImage && file_exists('../'.CONCIERGE_SHIP_IMAGE_FOLDER.DS.$shipRestaurantNoContentImage)){
                  ?>
                  <div class="row" style="margin-top:1%">
                    <div class="col-md-10 col-sm-10 col-xs-10">
                      <label class="form-label" style="color:#0969da">File No Content Restaurant Preview [ <i style="color:#696969"><?=$shipRestaurantNoContentImage;?></i> ]</label>
                      <div class="controls" style="text-align:left">
                        <img name='shipRestaurantNoContentImagePreview' src="../<?=CONCIERGE_SHIP_IMAGE_FOLDER.DS.$shipRestaurantNoContentImage.'?'.f_dateimagerenew();?>" style="width:300px; border:1px dotted #eaeaea; padding:5px; margin:5px;">
                      </div>
                    </div>
                  </div>
                  <div class="row" style="margin-top:1%">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                      <div class="form-group">
                        <label class="form-label">Filesize</label>
                        <div class="controls">
                          <p style='color:#0969da' name='shipRestaurantNoContentImageSize'><?=($shipRestaurantNoContentImageSize) ? f_filesSizeFormatShort($shipRestaurantNoContentImageSize) : null ; ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                      <div class="form-group">
                        <label class="form-label">Dimensions</label>
                        <div class="controls">
                          <p style='color:#0969da' name='shipRestaurantNoContentImageDimensions'><?=$shipRestaurantNoContentImageDimensions; ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>

                  <hr>

                  <div class="row" style="margin-top:1%">
                    <div class="col-md-2 col-sm-2 col-xs-2">
                      <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="controls">
                          <select class="form-control" name="shipStatus" id="shipStatus">
                          <?php
                          if ($aShipStatus) {
                            foreach ($aShipStatus as $key => $value) {
                              $selected = ($key == $shipStatus) ? 'selected' : '';
                              echo "<option value='$key' $selected >$value</option>";
                            }
                          }
                          ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr>

                  <div class="row" style="margin-top:1%;display:none" id='formValidationMessage'>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <div class="alert alert-error">
                        <?=FORM_VALIDATION_MESSAGE_ALERT?>
                      </div>
                    </div>
                  </div>

                  <div class="row" style="margin-top:1%">
                    <div class="col-md-8 col-sm-8 col-xs-8">
                      <div class="form-group">
                        <div class="controls">
                          <button class="btn btn-info" name="btnSave" style="width:100px;margin-right:20px">Save</button>
                          <?php echo (isset($shipID)) ? "<button class='btn btn-danger' name='btnDelete' style='width:100px;margin-right:20px'>Delete</button>" : null; ?>
                          <button class="btn btn-info" name="btnBack" style="width:100px;margin-right:20px">Back</button>
                        </div>
                      </div>
                    </div>
                  </div>

                </form>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      
    </div>

    <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrapv3/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-block-ui/jqueryblockui.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
    <script src="webarch/js/webarch.js" type="text/javascript"></script>
    <script src="assets/js/chat.js" type="text/javascript"></script>
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
    <script src="assets/js/form_elements.js" type="text/javascript"></script>

    <!-- ==== PREVIEW JS (GENÉRICO) ==== -->
    <script>
      $(function(){

        function humanFileSize(bytes) {
          const thresh = 1024;
          if (Math.abs(bytes) < thresh) return bytes + ' B';
          const units = ['KB','MB','GB','TB','PB','EB','ZB','YB'];
          let u = -1;
          do { bytes /= thresh; ++u; } while (Math.abs(bytes) >= thresh && u < units.length - 1);
          return bytes.toFixed(2) + ' ' + units[u];
        }

        function bindImagePreview(fileInputSelector, imgName, sizePName, dimPName, cssWidth) {
          $(document).on('change', fileInputSelector, function(){
            const file = this.files && this.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e){
              const $img = $("img[name='"+imgName+"']");
              if ($img.length) {
                $img.stop(true,true).hide().attr('src', e.target.result).css('width', cssWidth).fadeIn(600);
              }
              if (sizePName) {
                const $psize = $("p[name='"+sizePName+"']");
                if ($psize.length) { $psize.text(humanFileSize(file.size)).show(); }
              }
              if ($img.length && dimPName) {
                $img.off('load.__dim').on('load.__dim', function(){
                  const w = this.naturalWidth, h = this.naturalHeight;
                  const $pdim = $("p[name='"+dimPName+"']");
                  if ($pdim.length) { $pdim.text(`${w} × ${h} px`).show(); }
                });
              }
            };
            reader.readAsDataURL(file);
          });
        }

        // LOGO
        bindImagePreview("input[name='shipFileLogoNew']",
          "shipFileLogoPreview", "shipFileLogoSize", "shipFileLogoDimensions", "35%");

        // HOME IMAGE
        bindImagePreview("input[name='shipFileImageNew']",
          "shipFileImagePreview", "shipFileImageSize", "shipFileImageDimensions", "70%");

        // CONCIERGE NO CONTENT
        bindImagePreview("input[name='shipConciergeNoContentImageNew']",
          "shipConciergeNoContentImagePreview", "shipConciergeNoContentImageSize", "shipConciergeNoContentImageDimensions", "70%");

        // RESTAURANT NO CONTENT
        bindImagePreview("input[name='shipRestaurantNoContentImageNew']",
          "shipRestaurantNoContentImagePreview", "shipRestaurantNoContentImageSize", "shipRestaurantNoContentImageDimensions", "35%");

        // Botões (mantidos)
        $("button[name='btnDelete']").click(function(e){
          e.preventDefault();
          if(confirm('Do you really want to delete this Ship Data ?')){
              $("input[name='action']").val('exc');
              $("form").submit();
          } else {
              return false;
          }
        });
        
        $("button[name='btnBack']").click(function(e){
          e.preventDefault();
          window.location.replace("<?php echo PREVIUS_PAGE; ?>");
        });

        $("button[name='btnSave']").click(function(e){
          e.preventDefault();
          let validate = formValidate();
          if(validate["errors"]==0){
            if(validate["warnings"]>0){
              showValidateResult();
              if(confirm('There are pending items, do you want to save them? ?')){
                $("form").submit();
                return;
              } else {
                return false;
              }
            } else {
              $("form").submit();
              return;
            }
          } else {
            showValidateResult();
            return;
          }
        });

        function formValidate(){
          let err = [];
          let warn = [];
        
          if ($("input[name=shipName]").val() == "")  {
            err.push(['shipName', 'Enter the name of ship']);
          }
          
          if($("input[name=action]").val() == "ins" && $("input[name=shipFileLogo]").val() == ""){
            if ($("input[name=shipFileLogoNew]").val() == "")  {
              err.push(['shipFileLogoNew', 'Select the new ship logo file']);
            }
          }

          if($("input[name=action]").val() == "ins" && $("input[name=shipConciergeNoContentImage]").val() == ""){
            if ($("input[name=shipConciergeNoContentImageNew]").val() == "")  {
              err.push(['shipConciergeNoContentImageNew', 'Select the new ship Concierge no content file']);
            }
          }

          if($("input[name=action]").val() == "ins" && $("input[name=shipRestaurantNoContentImage]").val() == ""){
            if ($("input[name=shipRestaurantNoContentImageNew]").val() == "")  {
              err.push(['shipRestaurantNoContentImageNew', 'Select the new ship Restaurant no content file']);
            }
          }

          if($("input[name=action]").val() == "ins" && $("input[name=shipFileImage]").val() == ""){
            if ($("input[name=shipFileImageNew]").val() == "")  {
              err.push(['shipFileImageNew', 'Select the new ship image file']);
            }
          }

          sessionStorage.setItem('errors', JSON.stringify(err));
          sessionStorage.setItem('warnings', JSON.stringify(warn));

          return {errors: err.length, warnings: warn.length};
        }

        function showValidateResult(){
          const parsedE = JSON.parse(sessionStorage.getItem('errors'));
          const parsedW = JSON.parse(sessionStorage.getItem('warnings'));

          $("div.alert-dismissible").show("slow").delay(5000).hide("fast");
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
              $("label[id="+target+"]").attr("style", (style||'') + ";color:red;");
            });
          }

          $("div.alert-dismissible").show("slow").delay(5000).hide("fast");
          if(parsedW.length >0){
            parsedW.forEach((warnings) => {
              var target = warnings[0];
              var text = warnings[1];
              $("label[id="+target+"]").html(text);
              let style = $("label[id="+target+"]").attr('style');
              $("label[id="+target+"]").removeAttr("style");
              $("label[id="+target+"]").attr("style", (style||'') + ";color:orange;");
            });
          }
          sessionStorage.clear();
        }

      });
    </script>
    
  </body>
</html>