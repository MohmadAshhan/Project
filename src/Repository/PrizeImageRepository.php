<?php

namespace App\Repository;

use App\Entity\PrizeImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PrizeImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrizeImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrizeImage[]    findAll()
 * @method PrizeImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrizeImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrizeImage::class);
    }

    // /**
    //  * @return PrizeImage[] Returns an array of PrizeImage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PrizeImage
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
