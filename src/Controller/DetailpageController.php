<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetailpageController extends AbstractController
{
    #[Route('/detailpage', name: 'app_detailpage')]
    public function index(): Response
    {
        return $this->render('detailpage/index.html.twig', [
            'controller_name' => 'DetailpageController',
        ]);
    }
}
