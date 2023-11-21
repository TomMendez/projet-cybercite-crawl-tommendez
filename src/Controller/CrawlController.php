<?php

namespace App\Controller;

use App\Entity\Crawl;
use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
include 'src/Entity/Client.php';
use DateTimeInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CrawlController extends AbstractController
{
    #[Route('/', name: 'app_crawl')]
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

        # On crée un objet "Crawl" quit contient le résultat du crawl rélisé par l'API et utilise les setter générés par le framework pour affecter les valeurs
        $crawl = new Crawl();
        $crawl->setIdSite($siteId);
        $datetime = \DateTime::createFromFormat(DateTimeInterface::ISO8601, $date); # On change le string en type Date pour la BDD
        $crawl->setDate($datetime);
        # On formate le résultat du crawl en page html simple
        $rescrawl="<p>URLSite = {$rsltPositions[0]['url']}</p>"."\n"
                            ."<p>Moteur = {$rsltPositions[0]['moteur']['name']}</p>"."\n"
                            ."<p>Position = {$rsltPositions[0]['position']}</p>";
        $crawl->setResCrawl($rescrawl);

        # On echo directement notre variable, le code sera interprété par le navigateur
        echo("<h2>Résultat Crawl : </h2>" . $rescrawl);

        # On utilise leframework pour enregistrer en base de données notre Crawl
        $entityManager->persist($crawl);
        $entityManager->flush();

        # Pour ce projet, on ne modife pas la réponse par défaut du Controller qui sera rajoutée à la suite de notre echo dans le code html de la page
        return $this->render('crawl/index.html.twig', [
            'controller_name' => 'CrawlController',
        ]);
    }
}
