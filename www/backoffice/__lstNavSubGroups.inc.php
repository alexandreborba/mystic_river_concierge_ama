<?php
use Src\Models\SysNavSubGroups;
$navSubGroups = (new SysNavSubGroups())->find("navSubGroupStatus=:st AND deleted_at IS NULL","st=1")->fetch(true);
if($navSubGroups){
    $lstNavSubGroups[] = ' - Selecione - ';
    $lstNavSubGroups[0] = ' > Sem SubGrupo ';
    foreach($navSubGroups as $navSubGroup){
        $lstNavSubGroups[$navSubGroup->navSubGroupUUID] = $navSubGroup->navSubGroupName;
        # $lstNavSubGroups[$navSubGroup->navSubGroupUUID]["navGroupUUID"] = $navSubGroup->navGroupUUID;
        # $lstNavSubGroups[$navSubGroup->navSubGroupUUID]["navSubGroupName"] = $navSubGroup->navSubGroupName;
        # $lstNavSubGroups[$navSubGroup->navSubGroupUUID]["navSubGroupSeq"] = $navSubGroup->navSubGroupSeq;
    }
} else {
    $lstNavSubGroups[] = ' - Nenhum SubGrupo cadastrado - ';
}
