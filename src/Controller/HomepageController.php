<?php

namespace App\Controller;

use App\Service\VacanciesService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;


#[Route('/')]
class HomepageController extends AbstractController
{
    private $vacanciesService;

    public function __construct(VacanciesService $vacanciesService)
    {
        $this->vacanciesService = $vacanciesService;
    }

    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
       $vacancies = $this->vacanciesService->getAllVacancies();

         return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'vacancies' => $vacancies,
        ]);
    }

    #[Route('homepage/detailpage/{id}', name: 'detailpage')]
    public function detailpage($id)
    {
        $vacancy = $this->vacanciesService->getVacanciesById($id);

        return $this->render('detailpage/index.html.twig', [
            'controller_name' => 'DetailpageController',
            'vacancy' => $vacancy,
        ]);
    }
    
}
