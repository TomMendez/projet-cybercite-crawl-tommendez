<?php

namespace App\Controller;

use App\Entity\Crawl;
use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
include '../../Client.php';
use DateTimeInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CrawlController extends AbstractController
{
    #[Route('/crawl', name: 'app_crawl')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        # COPIE CODE GITHUB MODELE
        $config = json_decode(file_get_contents(__DIR__ . "/config.json"), true); # COPIE DU FICHIER PAS ELEGANT
        $datagarden = new Client(
            $config['user'],
            $config['password'],
            $config['url']);
        $siteId = $config['site']['id'];

        $datagarden->login();
        $aSite = $datagarden->getSiteInfos($siteId);
        $racId = $aSite['rapports'][0]['id'];
        $racInfos = $datagarden->getRapportInfos($racId);
        $moteurs = $racInfos['moteurs'];
        $date = $racInfos['last_date'];
        foreach($moteurs as $aMoteur) {
            $params=["date" =>$date, "outId" => $aMoteur["id"], "expressionId" => "352190"];
            $rsltPositions = $datagarden->getRapportPositionsResultats($racId, $params);
        }
        # COPIE CODE GITHUB MODELE


        $crawl = new Crawl();
        $crawl->setIdSite($siteId);
        $datetime = \DateTime::createFromFormat(DateTimeInterface::ISO8601, $date); #TEMPORAIRE
        $crawl->setDate($datetime);
        $rescrawl="{URLSite = {$rsltPositions[0]['url']}}"."<br>"."{Moteur = {$rsltPositions[0]['moteur']['name']}}"."<br>"."{Position = {$rsltPositions[0]['position']}}"."<br>";
        # var_dump($rescrawl);
        $crawl->setResCrawl($rescrawl);

        $entityManager->persist($crawl);
        $entityManager->flush();
        return $this->render('crawl/index.html.twig', [
            'controller_name' => 'CrawlController',
        ]);
    }

    public function addCrawl(EntityManagerInterface $entityManager, int $idSite, \DateTimeInterface $date, string $resCrawl): apache_response
    {
      $crawl = new Crawl();
      $crawl->setIdSite($idSite);
      $crawl->setDate($date);
      $crawl->setResCrawl($resCrawl);

      $entityManager->persist($crawl);
      $entityManager->flush();

      return Response(); # Temporaire
    }
}
