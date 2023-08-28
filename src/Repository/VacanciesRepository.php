<?php

namespace App\Repository;

use App\Entity\Vacancies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vacancies>
 *
 * @method Vacancies|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vacancies|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vacancies[]    findAll()
 * @method Vacancies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VacanciesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vacancies::class);
    }

//    /**
//     * @return Vacancies[] Returns an array of Vacancies objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Vacancies
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
