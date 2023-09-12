<?php

namespace App\Controller;

use App\Service\VacanciesService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class DetailpageController extends AbstractController
{
    private $vacanciesService;
    private $security;

    public function __construct(VacanciesService $vacanciesService, Security $security)
    {
        $this->vacanciesService = $vacanciesService;
        $this->security = $security;
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

    #[Route('/detailpage/apply/{id}', name: 'apply_detailpage')]
    public function applyVacancy($id)
    {
        if (!$this->security->isGranted('IS_AUTHENTICATED_FULLY')) {
           
            return $this->redirectToRoute('app_login');
        }
      
        return $this->redirectToRoute('app_detailpage', ['id' => $id]);
    }
}
