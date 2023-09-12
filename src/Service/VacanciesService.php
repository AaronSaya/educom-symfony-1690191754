<?php

namespace App\Service;

use App\Entity\Vacancies;
use App\Entity\Company;
use App\Repository\VacanciesRepository;

use DateTime;
use DateTimeInterface;

use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;



class VacanciesService
{
    private $security;
    private $entityManager;
    private $vacanciesRepository;

    public function __construct(VacanciesRepository $vacanciesRepository, Security $security, EntityManagerInterface $entityManager)
    {
        // Avoid calling getUser() in the constructor: auth may not
        // be complete yet. Instead, store the entire Security object.
        $this->security = $security;
        $this->entityManager = $entityManager;
        $this->vacanciesRepository = $vacanciesRepository;
    }

    // public function getVacancy()
    // {
    //     // returns User object or null if not authenticated
    //     $vacancy = $this->security->getVacancy();

    //     return $vacancy;
    // }

    // public function isAuthenticated()
    // {
    //     // Controleert of de gebruiker is geauthenticeerd
    //     return $this->security->isGranted('IS_AUTHENTICATED_FULLY');
    // }

    public function createVacancy(array $vacancyData, DateTimeInterface $currentDateTime, Company $company): Vacancies
    {
        return $this->vacanciesRepository->createVacancy($vacancyData, $currentDateTime, $company);
    }

    public function getVacanciesByCompany(Company $company): array
{
    return $this->vacanciesRepository->findBy(['company' => $company]);
}

public function getVacanciesById($id)
{
  return $this->vacanciesRepository->getVacanciesById($id);
}

public function removeVacancy($vacancy)
{
 return $this->vacanciesRepository->removeVacancy($vacancy);
}

public function getAllVacancies()
{
    return $this->vacanciesRepository->getAllVacancies();
}
    // public function updateUser(Vacancies $user, array $userData): Vacancies
    // {
    //     // Update the properties of the user entity based on $userData
    //     $user->setUsername($userData['username']);
    //     // ... update other properties ...

    //     $this->entityManager->flush();

    //     return $user;
    // }

    // public function deleteUser(User $user): void
    // {
    //     $this->entityManager->remove($user);
    //     $this->entityManager->flush();
    // }

    // public function getVacancyById(int $companyId): ?Company
    // {
    //     return $this->entityManager->getRepository(User::class)->find($userId);
    // }

}