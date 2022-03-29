<?php

namespace App\Controller;

use MovieApiDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(): Response
    {
        $movieAppDto = new MovieApiDto();
        $categories = $movieAppDto->getCategories();
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'categories'=>$categories,
        ]);
    }
    #[Route('/testpage/{idCategory}', name: 'test')]
        public function tester($idCategory): Response
    {
        $movieAppDto = new MovieApiDto();
        $filmCategories = $movieAppDto->getFilmByCategoryId($idCategory,20);
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'Accueil Controller',
            'movies' => $filmCategories,
        ]);
    }
}
