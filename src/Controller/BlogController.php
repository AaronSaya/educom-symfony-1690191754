<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;



#[Route('/blog')]
class BlogController extends BaseController
{
  #[Route('/blog', name: 'blog_list')]
  #[Template()]
  public function index()
  {
    return ['controller_name' => 'BlogController'];
  }

  #[Route('/show/{id}', name: 'blog_show')]
    public function show(Request $request, $id = 1)
    {
        $logLevel = $request->query->get('log_level', 'info'); // Standaard naar 'info' als log_level niet wordt meegegeven

        $this->log('Dit is een bericht met het logniveau ' . $logLevel, $logLevel);

        dd($logLevel);
    }

  #[Route('/{page}', name: 'blog_list', requirements: ['page' => '\d+'])]
  public function list($page)
  {
    //Voer hier de logica uit om de lijst van blogposts voor de opgegeven pagina op te halen
    $content = "List page: " . $page;

    return new Response($content);
  }

  #[Route('/{slug}', name: 'blog_show_slug')]
  public function show_slug($slug)
  {
    //Voer hier de logica uit om het specifieke blogartikel op te halen
    return new Response("Show blog with slug: " . $slug);
  }
}
