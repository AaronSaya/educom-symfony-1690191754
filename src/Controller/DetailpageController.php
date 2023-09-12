<?php

namespace App\Controller;

use App\Service\VacanciesService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetailpageController extends AbstractController
{
    private $vacanciesService;

    public function __construct(VacanciesService $vacanciesService)
    {
        $this->vacanciesService = $vacanciesService;
    }

    #[Route('/detailpage', name: 'app_detailpage')]
    public function index($id): Response
    {
        $vacancy = $this->vacanciesService->getVacanciesById($id);

        if ($vacancy) {
          $this->vacanciesService->removeVacancy($vacancy);
      }
        return $this->render('detailpage/index.html.twig', [
            'vacancy' => $vacancy,
        ]);
    }
}
