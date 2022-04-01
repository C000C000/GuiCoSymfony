<?php

namespace App\Controller;

use MovieApiDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FicheFilmController extends AbstractController
{
    #[Route('/fiche/film/{id}', name: 'app_fiche_film')]
    public function index($id): Response
    {

        $movieApiDto = new MovieApiDto();
        $movie = $movieApiDto->getFilmById($id);
        //DD($movie);
        return $this->render('fiche_film/index.html.twig', [
            'controller_name' => 'FicheFilmController',
            'movie' => $movie,
        ]);
    }
}
