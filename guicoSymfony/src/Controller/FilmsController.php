<?php

namespace App\Controller;

use MovieApiDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmsController extends AbstractController
{
    #[Route('/films', name: 'films')]
    public function index(): Response
    {
        $movieAppDto = new MovieApiDto();
        //Remplacer par page
        $movies = $movieAppDto->getPopular(1);
        $categorie = $movieAppDto->getCategories();
        return $this->render('films/index.html.twig', [
            'controller_name' => 'FilmsController',
            'categorie' => $categorie,
            'movies' => $movies,
            'controller' => $movieAppDto,
        ]);
    }
}
