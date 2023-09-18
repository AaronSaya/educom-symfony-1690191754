<?php

namespace App\Repository;

use App\Entity\Activities;
use App\Entity\User;
use App\Entity\Vacancies;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;

/**
 * @extends ServiceEntityRepository<Activities>
 *
 * @method Activities|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activities|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activities[]    findAll()
 * @method Activities[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivitiesRepository extends ServiceEntityRepository
{
    private $user;
    private $vacancies;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activities::class);
    }

    public function applyVacancy($id)
{

    // Haal de huidige gebruiker op
    $user = $this->getUser();

    // Haal de vacature op
    $vacature = $this->getDoctrine()->getRepository(Vacature::class)->find($id);

    if (!$vacature) {
        // Voeg hier eventueel foutafhandeling toe als de vacature niet bestaat
        // bijvoorbeeld een 404-foutpagina weergeven
        // of doorverwijzen naar een andere actie
        return $this->redirectToRoute('error_route'); // Vervang 'error_route' door de juiste route
    }

    // Maak de sollicitatie-entiteit aan en sla deze op
    $application = new Activities();
    $application->setUser($user);
    $application->setVacature($vacature);

    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($application);
    $entityManager->flush();

    // Voeg hier eventueel een bevestigingsbericht of doorverwijzing toe
    // naar een bedankpagina na het solliciteren

    return $this->redirectToRoute('activities/activities.html.twig'); // Vervang 'confirmation_route' door de juiste route
}

//    /**
//     * @return Activities[] Returns an array of Activities objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Activities
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
