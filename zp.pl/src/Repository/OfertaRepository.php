<?php

namespace App\Repository;

use App\Entity\Oferta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Oferta|null find($id, $lockMode = null, $lockVersion = null)
 * @method Oferta|null findOneBy(array $criteria, array $orderBy = null)
 * @method Oferta[]    findAll()
 * @method Oferta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfertaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Oferta::class);
    }

    // /**
    //  * @return Oferta[] Returns an array of Oferta objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Oferta
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
