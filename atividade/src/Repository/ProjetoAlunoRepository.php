<?php

namespace App\Repository;

use App\Entity\ProjetoAluno;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProjetoAluno|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjetoAluno|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjetoAluno[]    findAll()
 * @method ProjetoAluno[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjetoAlunoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjetoAluno::class);
    }

    // /**
    //  * @return ProjetoAluno[] Returns an array of ProjetoAluno objects
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
    public function findOneBySomeField($value): ?ProjetoAluno
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
