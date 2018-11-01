<?php

namespace App\Repository;

use App\Entity\Useraccess;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Useraccess|null find($id, $lockMode = null, $lockVersion = null)
 * @method Useraccess|null findOneBy(array $criteria, array $orderBy = null)
 * @method Useraccess[]    findAll()
 * @method Useraccess[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UseraccessRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Useraccess::class);
    }

//    /**
//     * @return Useraccess[] Returns an array of Useraccess objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Useraccess
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
