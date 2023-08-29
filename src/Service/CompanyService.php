<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use App\Repository\CompanyRepository;
use App\Entity\Company;

class CompanyService {

    /** @var UserRepository $userRepository */    
    private $userRepository;
    /** @var CompanyRepository $companyRepository */    
    private $companyRepository;

    public function __construct(EntityManagerInterface $em) {
        $this->companyRepository = $em->getRepository(Company::class);
    }

    private function fetchUser($id = null) {
        if(is_null($id)) return(null);
        return($this->userRepository->fetchUser($id));
    }

    private function fetchCompany($id) {
        return($this->companyRepository->fetchCompany($id));
    }

    public function createCompany($params) {
        $data = [
          "id" => (isset($params["id"]) && $params["id"] != "") ? $params["id"] : null,
          "name" => $params["name"],
          "location" => $params["location"],
          "logo_url" => $params["logo_url"],            
        ];

        $result = $this->companyRepository->createCompany($data);
        return($result);
    }
}