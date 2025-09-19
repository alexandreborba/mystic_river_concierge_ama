<?php
use Src\Models\SysNavGroups;
$navGroups = (new SysNavGroups())->find("navGroupStatus=:st AND deleted_at IS NULL","st=1")->fetch(true);
if($navGroups){
    $lstNavGroups[] = ' - Selecione - ';
    $lstNavGroups[0] = ' > Sem Grupo ';
    foreach($navGroups as $navGroup){
        $lstNavGroups[$navGroup->navGroupUUID] = $navGroup->navGroupName;
        # $lstNavGroups[$navGroup->navGroupUUID]["navGroupName"]  = $navGroup->navGroupName;
        # $lstNavGroups[$navGroup->navGroupUUID]["navGroupIcon"]  = $navGroup->navGroupIcon;
        # $lstNavGroups[$navGroup->navGroupUUID]["navGroupSeq"]   = $navGroup->navGroupSeq;
        # $lstNavGroups[$navGroup->navGroupUUID]["navGroupUUID"]  = $navGroup->navGroupUUID;
    }
} else {
    $lstNavGroups[] = ' - Nenhum Grupo cadastrado - ';
}
#f_dump($lstNavGroups, 'lstNavGroups');exit;