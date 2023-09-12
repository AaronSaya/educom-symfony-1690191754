<?php

namespace App\Controller;

use App\Service\UserService;
use App\Service\VacanciesService;
use App\Service\ImportCompanyService;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class CompanyController extends AbstractController
{
    private $userService;
    private $importcompanyservice;
    private $vacanciesService;

    public function __construct(UserService $userService, ImportCompanyService $importcompanyservice, VacanciesService $vacanciesService)
    {
        $this->userService = $userService;
        $this->importcompanyservice = $importcompanyservice;
        $this->vacanciesService = $vacanciesService;
    }

    #[Route('/company', name: 'app_company')]
    public function index(): Response
    {
        $user = $this->userService->getUser();
        $company = $user->getCompany();
        $vacancies = $this->vacanciesService->getVacanciesByCompany($company);

        $vacancyData = [

            'title' => '',
            'level' => '',
            'location' => '',
            'description' => '',
            'logo_function_url' => '',
        ];

        return $this->render('company/company.html.twig', [
            'user' => $user,
            'vacancyData' => $vacancyData,
            'company' => $company,
            'vacancies' => $vacancies,
        ]);
    }

    #[Route('/company/createvacancy', name :'create_vacancy_form', methods: "POST")]
    public function createVacancy(Request $request): Response
    {   
        $user = $this->userService->getUser();
        $currentDateTime = new DateTime(); 
        $vacancyData = $request->request->all();
        $company = $user->getCompany();
       
        $vacancyData = $request->request->all();
        $this->vacanciesService->createVacancy($vacancyData,$currentDateTime, $company );

        return $this->redirectToRoute('app_company');
    }

    #[Route('/company/deletevacancy/{id}', name: 'delete_vacancy', methods: 'POST')]
    public function deleteVacancy($id): Response
    {
      
      $vacancy = $this->vacanciesService->getVacanciesById($id);

      if ($vacancy) {
        $this->vacanciesService->removeVacancy($vacancy);
    }

       return $this->redirectToRoute('app_company');
    }
    
}
