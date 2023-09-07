<?php

namespace App\Service;

use App\Repository\CompanyRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class ImportCompanyService
{
    private $companyRepository;
    private $passwordHasher;
    private $csrfTokenManager;

    public function __construct(CompanyRepository $companyRepository, UserPasswordHasherInterface $passwordHasher, CsrfTokenManagerInterface $csrfTokenManager)
    {
        $this->companyRepository = $companyRepository;
        $this->passwordHasher = $passwordHasher;
        $this->csrfTokenManager = $csrfTokenManager;
    }

    public function saveCompany($data, $passwordHasher, $csrfToken)
    {
        $this->companyRepository->saveCompany($data, $passwordHasher, $csrfToken);
       }

}
