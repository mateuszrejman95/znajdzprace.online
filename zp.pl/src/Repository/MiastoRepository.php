<?php

namespace App\Repository;

use App\Entity\Miasto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Miasto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Miasto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Miasto[]    findAll()
 * @method Miasto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MiastoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Miasto::class);
    }

    // /**
    //  * @return Miasto[] Returns an array of Miasto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Miasto
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
