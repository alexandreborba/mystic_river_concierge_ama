<div class="pull-left">
  <ul class="nav quick-section">
    <li class="quicklinks">
      <!-- icone Home -->
      <a href="#" class="" id="layout-condensed-toggle">
        <i class="material-icons">menu</i>
      </a>
    </li>
  </ul>
  <ul class="nav quick-section">
    <li class="quicklinks  m-r-10">
      <!-- icone Reload -->
      <a href="#" class="">
        <i class="material-icons">refresh</i>
      </a>
    </li>
    <li class="quicklinks">
      <!-- manager info -->
      <div style='padding:6px;color:#02244F'>
        <?php include_once __DIR__ . "/__lstLanguages.inc.php"; ?>
        <?='<strong style="color:red">'.f_upper(CONTAINER_NAME).'</strong> - '.'<strong>'.f_decode($_SESSION[CONTAINER_NAME."_mName"]).'</strong> | <i>'.f_decode($_SESSION[CONTAINER_NAME."_mFunction"]).'</i> | '.f_decode($_SESSION[CONTAINER_NAME."_mEmail"]). ' | ';?>
      </div>
    </li>
  </ul>
  
</div>
