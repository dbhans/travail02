<?php

namespace App\Repository;

use App\Entity\Tranfers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tranfers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tranfers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tranfers[]    findAll()
 * @method Tranfers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TranfersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tranfers::class);
    }

//    /**
//     * @return Tranfers[] Returns an array of Tranfers objects
//     */
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
    public function findOneBySomeField($value): ?Tranfers
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
