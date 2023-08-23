<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VacanciesController extends AbstractController
{
    #[Route('/vacancies', name: 'app_vacancies')]
    public function index(): Response
    {
        return $this->render('vacancies/index.html.twig', [
            'controller_name' => 'VacanciesController',
        ]);
    }
}
