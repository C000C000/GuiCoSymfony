<?php

namespace App\Controller;

use MovieApiDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResultatController extends AbstractController
{
    #[Route('/resultat/{idCategory}', name: 'app_resultat')]
    public function index($idCategory): Response
    {
        $movieAppDto = new MovieApiDto();
        $filmCategories = $movieAppDto->getFilmByCategoryId($idCategory,25);
        return $this->render('resultat/index.html.twig', [
            'controller_name' => 'ResultatController',
            'movies' => $filmCategories,
        ]);
    }
}
