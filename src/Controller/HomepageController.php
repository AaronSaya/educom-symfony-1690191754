<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Entity\User;
use App\Repository\UserRepository;

#[Route('/')]
class HomepageController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index()
    {
        /** @var UserRepository $rep */
         $rep = $this->getDoctrine()->getRepository(User::class);
         $data = $rep->getAllUsers();

        // dump($data);
        // die();

         return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'data' => $data,
        ]);
    }
    
}
