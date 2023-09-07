<?php

namespace App\Controller;

use App\Service\UserService;
use App\Service\ImportCompanyService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class CompanyController extends AbstractController
{
    private $userService;
    private $importcompanyservice;

    public function __construct(UserService $userService, ImportCompanyService $importcompanyservice)
    {
        $this->userService = $userService;
        $this->importcompanyservice = $importcompanyservice;  
    }

    #[Route('/company', name: 'app_company')]
    public function index(): Response
    {
        $user = $this->userService->getUser();
        $company = $this->importcompanyservice->getCompany($user);
        dd($company);





        return $this->render('company/company.html.twig', [
            'company' => $company,
        ]);
    }
}
