<?php

namespace App\Repository;

use App\Entity\Crawl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Crawl>
 *
 * @method Crawl|null find($id, $lockMode = null, $lockVersion = null)
 * @method Crawl|null findOneBy(array $criteria, array $orderBy = null)
 * @method Crawl[]    findAll()
 * @method Crawl[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CrawlRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Crawl::class);
    }

//    /**
//     * @return Crawl[] Returns an array of Crawl objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Crawl
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
