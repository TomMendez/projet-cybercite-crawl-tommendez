<?php

namespace App\Controller;

use App\Entity\Crawl;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CrawlController extends AbstractController
{
    #[Route('/crawl', name: 'app_crawl')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $crawl = new Crawl();
        $crawl->setIdSite(0);
        $date = \DateTime::createFromFormat('Y-m-d', '2022-11-11'); #TEMPORAIRE
        $crawl->setDate($date);
        $crawl->setResCrawl("test");

        $entityManager->persist($crawl);
        $entityManager->flush(); # PROBLEME CETTE LIGNE CAUSE UNE ERREUR
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
