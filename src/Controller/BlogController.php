<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Psr\Log\LoggerInterface;

#[Route('/blog')]
class BlogController extends BaseController
{
    #[Route('/blog', name: 'blog_list')]
    #[Template()]
    public function index(): Response
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    #[Route('/show/{level}', name: 'blog_show')]
    public function show(LoggerInterface $logger, $level) {
        if ($level == 'info') {
            $logger->info("info Message");
        } elseif ($level == 'warning') {
            $logger->warning("Warning Message");
        } else {
            $logger->error("This is an error message");
        }
    
        dd($level);
    }

 
}
