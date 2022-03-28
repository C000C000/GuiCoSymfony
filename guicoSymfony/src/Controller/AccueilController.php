<?php

namespace App\Controller;

use MovieApiDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
    #[Route('/testpage/{id}', name: 'test')]
    public function tester($id): Response
    {
        $movieAppDto = new MovieApiDto();
        //$films = $movieAppDto->getFilmsByName("con");
        $films = $movieAppDto->getPopularMovies($id);
        //$film = $movieAppDto->getFilmById($id);
        //$image = $movieAppDto->getImageFromName($film->backdrop_path);
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'Accueil Controller',
            'films'=>$films,
        ]);
    }
}
