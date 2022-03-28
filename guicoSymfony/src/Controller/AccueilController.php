<?php

namespace App\Controller;

use MovieApiDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
    #[Route('/testpage', name: 'test')]
    public function tester(): Response
    {
        $movieAppDto = new MovieApiDto();
        //$films = $movieAppDto->getFilmsByName("con");
        $film = $movieAppDto->getFilmById(153);
        $image = $movieAppDto->getImageFromName($film->backdrop_path);
        //DD($films);
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'Accueil Controller',
            'film'=>$film,
            'image'=>$image
        ]);
    }
}
