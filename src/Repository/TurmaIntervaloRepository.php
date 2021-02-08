<?php

namespace App\Repository;

use App\Entity\TurmaIntervalo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TurmaIntervalo|null find($id, $lockMode = null, $lockVersion = null)
 * @method TurmaIntervalo|null findOneBy(array $criteria, array $orderBy = null)
 * @method TurmaIntervalo[]    findAll()
 * @method TurmaIntervalo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TurmaIntervaloRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TurmaIntervalo::class);
    }

    // /**
    //  * @return TurmaIntervalo[] Returns an array of TurmaIntervalo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TurmaIntervalo
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
