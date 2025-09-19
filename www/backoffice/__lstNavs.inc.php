<?php
use Src\Models\SysNavs;
$navs = (new SysNavs())->find("navStatus=:st AND deleted_at IS NULL","st=1")->fetch(true);
if($navs){
    $lstNavs[] = ' - Selecione - ';
    foreach($navs as $nav){
        $lstNavs[$nav->navUUID] = $nav->navName;
        $lstNavs[$nav->navUUID]["navGroupUUID"] = $nav->navGroupUUID;
        $lstNavs[$nav->navUUID]["navSubGroupUUID"] = $nav->navSubGroupUUID;
        $lstNavs[$nav->navUUID]["navName"] = $nav->navName;
        $lstNavs[$nav->navUUID]["navUrl"]  = $nav->navUrl;
        $lstNavs[$nav->navUUID]["navSeq"]  = $nav->navSeq;
    }
} else {
    $lstNavs[] = ' - Nenhum Item cadastrado - ';
}
