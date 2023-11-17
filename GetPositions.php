<?php
include "vendor/autoload.php";
include "common.inc.php";

use App\Controller\CrawlController;
use Doctrine\ORM\EntityManagerInterface;

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
    # $entityManager = $doctrine->getManager();
    # $cc = new CrawlController();
    # $datetime = \DateTime::createFromFormat('Y-m-d', '2022-11-11'); #TEMPORAIRE utiliser $date

    # $cc->addCrawl($entityManager, $siteId, $datetime , "crawl test temporaire"); #TEMPORAIRE

} catch (\Exception $exp) {
    var_dump($exp->getMessage());
}
