<?php

namespace App\Repository;

use App\Entity\Vacancies;
use App\Entity\Company;

use DateTimeInterface;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

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

    public function createVacancy(array $vacancyData, DateTimeInterface $currentDateTime, Company $company): Vacancies
    {
        $vacancy = new Vacancies();
        $vacancy->setDate($currentDateTime);
        $vacancy->setTitle($vacancyData['title']);
        $vacancy->setLevel($vacancyData['level']);
        $vacancy->setLocation($vacancyData['location']);
        $vacancy->setDescription($vacancyData['description']);
        $vacancy->setLogoFunctionUrl($vacancyData['logo_function_url']);

        $vacancy->setCompany($company);

        $this->_em->persist($vacancy);
        $this->_em->flush();

        return $vacancy;
    }

    public function getVacanciesByCompany(Company $company): array
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.company = :company')
            ->setParameter('company', $company)
            ->getQuery()
            ->getResult();
    }

    public function getVacanciesById($id)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function removeVacancy($vacancy): void
     {
         $this->_em->remove($vacancy);
         $this->_em->flush();
    }
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
