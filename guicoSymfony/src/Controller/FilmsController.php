<?php

namespace App\Controller;

use MovieApiDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmsController extends AbstractController
{
    #[Route('/films/{page}', name: 'films')]
    public function index($page): Response
    {


        $movieAppDto = new MovieApiDto();
        //Remplacer par page
        $movies = $movieAppDto->getPopular($page);
        $categories = $movieAppDto->getCategories();
        return $this->render('films/index.html.twig', [
            'controller_name' => 'FilmsController',
            'categorie' => $categories,
            'movies' => $movies,
            'controller' => $movieAppDto,
            'categories'=>$categories,
        ]);
    }
    #[Route('/films', name: 'filmsByName')]
    public function filmbyname( Request $request): Response
    {
        $recherche = $request->get('search');
        $movieAppDto = new MovieApiDto();
        //Remplacer par page
        $movies = $movieAppDto->getFilmsByName($recherche);
        DD($movies);
        $categorie = $movieAppDto->getCategories();
        return $this->render('films/index.html.twig', [
            'controller_name' => 'FilmsController',
            'categorie' => $categorie,
            'movies' => $movies,
            'controller' => $movieAppDto,
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
