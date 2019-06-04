<?php

namespace App\Repository;

use App\Entity\Panstwo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Panstwo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Panstwo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Panstwo[]    findAll()
 * @method Panstwo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PanstwoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Panstwo::class);
    }

    // /**
    //  * @return Panstwo[] Returns an array of Panstwo objects
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
    public function findOneBySomeField($value): ?Panstwo
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
