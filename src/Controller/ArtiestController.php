<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtiestController extends AbstractController
{
    #[Route('/artiest', name: 'artiest')]
    public function index(): Response
    {
       /// We simuleren hier even een $_POST van een formulier
       $artiest = [
        "naam" => "Gary Clark jr.",
        "genre" => "Blues Rock",
        "omschrijving" => "BlaBlaBlaBlaBlaBlaBlaBlaBlaBl",
        "afbeelding_url" => "https://www.billboard.com/wp-content/uploads/media/Gary-Clark-Jr.-Portrait-Shoot-London-2015-a-billboard-1548.jpg",
        "website" => "https://www.garyclarkjr.com/",
       ];
        
       /** @var ArtiestRepository $rep */
       $rep = $this->getDoctrine()->getRepository(Artiest::class);
       $result = $rep->saveArtiest($artiest);

       dd($result);

    }
}
