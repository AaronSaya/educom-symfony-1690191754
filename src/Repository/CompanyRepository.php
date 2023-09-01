<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Company;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Company>
 */
class CompanyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Company::class);
    }

    public function createCompanyAndUser(
        string $name,
        string $address,
        string $location,
        string $postalCode,
        string $email,
        string $phonenumber
    ): void {
        $company = new Company();
        $company->setName($name);
        $company->setAddress($address);
        $company->setLocation($location);
        $company->setPostalCode($postalCode);
        $company->setEmail($email);
        $company->setPhonenumber($phonenumber);

        // Generate username and password
        $username = strtolower($name);
        $password = $name;

        $user = new User();
        $user->setUsername($username);
        $user->setPassword($password); // You can update this to use hashing
        $user->setRoles(['ROLE_EMPLOYER']);

        $company->setUser($user);

        $this->_em->persist($company);
        $this->_em->flush();
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