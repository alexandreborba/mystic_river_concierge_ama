

<?php
@session_start();
require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../src/Parameters.php';
require_once __DIR__. '/../src/Functions.php';
require_once __DIR__. '/../src/Tools/Translator.php';
include_once __DIR__. "/__session_verify.php";
ini_set("display_errors", 0);
#error_reporting(E_ALL);

use Src\Models\SysNavGroups;
use Src\Models\SysNavSubGroups;
use Src\Models\VwSysNavs;
?>
<p class="menu-title sm">OPÇÕES <span class="pull-right"></p>
<ul>
<?php
// listar os navs sem grupo
$navs = (new VwSysNavs())->find("navGroupUUID IS NULL AND navStatus=:st AND deleted_at IS NULL","st=1")->order("navSeq ASC")->fetch(true);
if($navs) {
    foreach($navs as $nav) {
        echo '<li>';
        echo    "<a href='{$nav->navUrl}'><i class='material-icons'>{$nav->navIcon}</i> <span class='title'>{$nav->navName}</span> </a>";
        echo '</li>';
    }
}else{
    // lista os navs com grupo e subgrupo
    $groups = (new SysNavGroups())->find("navGroupStatus=:st AND deleted_at IS NULL","st=1")->order("navGroupSeq ASC")->fetch(true);
    if($groups) {
        foreach($groups as $group) {

            echo "<li class='start'>";
                echo "<a href='#'>";
                echo "<i class='material-icons'>{$group->navGroupIcon}</i>";
                echo "<span class='title'>{$group->navGroupName}</span> ";
                echo "<span class='selected'></span> ";
                echo "<span class='arrow'></span> ";
                echo "</a>";
                
                // listar os subgrupos se existir, senao lista navs
                echo "<ul class='sub-menu'>";
                // verificar se tem subgrupos 
                $subGroupsNot = (new VwSysNavs())->find("navGroupUUID=:uuid AND navSubGroupUUID IS NULL AND navStatus=:st AND deleted_at IS NULL","uuid={$group->navGroupUUID}&st=1")->count();
                # echo "subGroupsNot {$subGroupsNot}";exit;
                if($subGroupsNot>0){
                    // listar os navs do grupo sem subgrupo
                    $navs = (new VwSysNavs())->find("navGroupUUID=:uuid AND navSubGroupUUID IS NULL AND navStatus=:st AND deleted_at IS NULL","uuid={$group->navGroupUUID}&st=1")->order("navSeq ASC")->fetch(true);
                    if($navs) {
                        #echo "<li class='nav-group-no-subgroup'>";
                        foreach($navs as $nav) {
                            echo "<li><a href='{$nav->navUrl}'> - {$nav->navName}</a></li>";
                        }
                        #echo "</li>"; // end nav-group-no-subgroup
                    }
                } // end if not

                $subGroupsYes = (new SysNavSubGroups())->find("navGroupUUID=:uuid AND navSubGroupStatus=:st AND navSubGroupUUID IS NOT NULL AND deleted_at IS NULL","uuid={$group->navGroupUUID}&st=1")->order("navSubGroupSeq ASC")->fetch(true);
                if($subGroupsYes){
                    foreach($subGroupsYes as $subGroup) {
                        echo "<li>";
                            echo "<a href='javascript:;'>";
                            echo    "<span class='title'>{$subGroup->navSubGroupName}</span>";
                            echo    "<span class='arrow'></span>";
                            echo "</a>";
                            #echo "<a href='#' class='nav-subgroup' data-uuid='{$subGroup->navSubGroupUUID}'> > {$subGroup->navSubGroupName}</a>";
                            echo "<ul class='sub-menu'>";

                            // listar os navs do subgrupo
                            $navs = (new VwSysNavs())->find("navSubGroupUUID=:subgroup_uuid AND navStatus=:st AND deleted_at IS NULL","subgroup_uuid={$subGroup->navSubGroupUUID}&st=1")->order("navSeq ASC")->fetch(true);
                            #$iNavs = (new VwSysNavs())->find("navSubGroupUUID=:subgroup_uuid AND navStatus=:st AND deleted_at IS NULL","subgroup_uuid={$subGroup->navSubGroupUUID}&st=1")->count();
                            #echo "iNavs {$iNavs}";exit;
                            if($navs) {
                                foreach($navs as $nav) {
                                    echo "<li><a href='{$nav->navUrl}'> - {$nav->navName}</a></li>";
                                    echo ($nav->navSpace>0) ? '<li>&nbsp;</li>' : null;
                                }
                            }
                            echo "</ul>"; // end nav-subgroup-list
                        echo "</li>"; // end subgroup
                        echo ($subGroup->navSubGroupSpace>0) ? '<li>&nbsp;</li>' : null;

                    } // end foreach

                } // end if subgroups yes

                echo "</ul>";

            echo "</li>";
            echo ($group->navGroupSpace>0) ? '<li>&nbsp;</li>' : null;
        } // end foreach groups
    } // end if 
}
?>
</ul>