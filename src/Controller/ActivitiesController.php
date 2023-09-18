<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActivitiesController extends AbstractController
{
    #[Route('/activities{id}', name: 'app_activities')]
    public function index($id): Response
    {
        return $this->render('activities/activities.html.twig', [
            'controller_name' => 'ActivitiesController',
            'id' => $id,
        ]);
    }
}
