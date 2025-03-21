<?php

namespace App\Repository;

use App\Entity\PvRecettage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PvRecettage>
 */
class PvRecettageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PvRecettage::class);
    }

    public function findExistingVersion(PvRecettage $pvRecettage): ?PvRecettage
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.pvRecettages', 'prev')
            ->where('prev.id = :pvId')
            ->setParameter('pvId', $pvRecettage->getId())
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }


//    /**
//     * @return PvRecettage[] Returns an array of PvRecettage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PvRecettage
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
