<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Company;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class CompanyRepository extends ServiceEntityRepository
{
    private $passwordHasher;
    private $csrfTokenManager;

    public function __construct(ManagerRegistry $registry, UserPasswordHasherInterface $passwordHasher, CsrfTokenManagerInterface $csrfTokenManager)
    {
        parent::__construct($registry, Company::class);
        $this->passwordHasher = $passwordHasher;
        $this->csrfTokenManager = $csrfTokenManager;
    }

    public function saveCompany($data)
    {
        foreach ($data as $key) {

            $company = new Company();
            $company->setName($key['0']);
            $company->setAddress($key['1']);
            $company->setLocation($key['2']);
            $company->setPostalCode($key['3']);
            $company->setEmail($key['4']);
            $company->setPhonenumber($key['5']);
            $company->setLogoUrl($key['6']);

            $this->_em->persist($company);

            // Generate username and password
            $username = strtolower($key['0']);
            $password = $key['0'];

            $user = new User();
            $user->setUsername($username);
            $hashedPassword = $this->passwordHasher->hashPassword($user, $password);
            $user->setPassword($hashedPassword);
            $user->setRoles(['ROLE_EMPLOYER']);

            $company->setUser($user);

            $this->_em->persist($company);
            $this->_em->flush();
        }
        return $company;
    }

    public function findAllCompanies(): array
    {
        return $this->findAll();
    }

    public function findCompanyById(int $id): ?Company
    {
        return $this->find($id);
    }

    public function updateCompany(Company $company): void
    {
        $this->_em->persist($company);
        $this->_em->flush();
    }

    public function deleteCompany(Company $company): void
    {
        $this->_em->remove($company);
        $this->_em->flush();
    }
}
