<?php
include "vendor/autoload.php";
include "common.inc.php";

try {
    $datagarden->login();
    $aSite = $datagarden->getSiteInfos($siteId);
    $racId = $aSite['rapports'][0]['id'];
    $racInfos = $datagarden->getRapportInfos($racId);
    $moteurs = $racInfos['moteurs'];
    $date = $racInfos['last_date'];
    foreach($moteurs as $aMoteur) {
        $params=["date" =>$date, "outId" => $aMoteur["id"], "expressionId" => "352190"];
        $rsltPositions = $datagarden->getRapportPositionsResultats($racId, $params);
        var_dump($rsltPositions);
    }
} catch (\Exception $exp) {
    var_dump($exp->getMessage());
}
