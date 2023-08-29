<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

use App\Repository\UserRepository;
use App\Repository\CompanyRepository;


class CompanyService {

    /** @var UserRepository $userRepository */    
    private $userRepository;
    /** @var CompanyRepository $companyRepository */    
    private $companyRepository;

    public function __construct(EntityManagerInterface $em) {
        $this->userRepository = $em->getRepository(Optreden::class);
        $this->companyRepository = $em->getRepository(Artiest::class);
    }

    private function fetchUser($id = null) {
        if(is_null($id)) return(null);
        return($this->userRepository->fetchUser($id));
    }

    private function fetchCompany($id) {
        return($this->companyRepository->fetchCompany($id));
    }

    public function saveCompany($params) {
        $data = [
          "id" => (isset($params["id"]) && $params["id"] != "") ? $params["id"] : null,
          "omschrijving" => $params["omschrijving"],
          "datum" => new \DateTime($params["datum"]),
          "prijs" => $params["prijs"],
          "ticket_url" => $params["ticket_url"],
          "afbeelding_url" => $params["afbeelding_url"],              
          "poppodium" => $this->fetchUser($params["poppodium_id"]),
          "voorprogramma" => $this->fetchCompany($params["voorprogramma_id"]),
        ];

        $result = $this->companyRepository->saveCompany($data);
        return($result);
    }
}