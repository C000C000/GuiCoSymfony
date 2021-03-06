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
        $user = $this->getUser();
        $unAge = $user->getAge();
        if($unAge < 18){
            $filmCategories = $movieAppDto->getFilmByCategoryId($idCategory,25, false);
        }else{
            $filmCategories = $movieAppDto->getFilmByCategoryId($idCategory,25);
        }


        return $this->render('resultat/index.html.twig', [
            'controller_name' => 'ResultatController',
            'movies' => $filmCategories,
        ]);
    }
}
