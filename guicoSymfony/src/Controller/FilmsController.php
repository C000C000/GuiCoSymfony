<?php

namespace App\Controller;

use App\Dto\RechercheDto;
use App\Form\RechercheType;
use MovieApiDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmsController extends AbstractController
{
        #[Route('/films/{page}', name: 'films')]
    public function index($page, Request $request): Response
    {

        $recherche = new RechercheDto();
        $form = $this->createForm(RechercheType::class);

        $movieAppDto = new MovieApiDto();
        //Remplacer par page
        $categories = $movieAppDto->getCategories();
        /** @var User $user */
        $user = $this->getUser();
        //Récup data form
        $form->handleRequest($request);
        $data = $form->getData();
        if(!$data == null){
            $movies = $movieAppDto->getFilmsByName($data->getInput());
        }else{
            //Utiliser cette méthode si l'utilisateur a moins de 18 ans
            //Sinon utiliser l'ancienne avec getPopular
            if(!$user == null && $user->getAge() >= 18){
                $movies = $movieAppDto->getFilmAdultContentFiltered(10,false);
            }else{
                $movies = $movieAppDto->getPopular(1)->results;
            }
        }

        //Si on utilise getPopular => $movies->results
        //Sinon juste movies
        return $this->render('films/index.html.twig', [
            'controller_name' => 'FilmsController',
            'categorie' => $categories,
            'movies' => $movies,
            'controller' => $movieAppDto,
            'categories'=>$categories,
            'form'=>$form->createView(),
            'user' => $user,
        ]);
    }
    #[Route('/films', name: 'filmsByName')]
    public function filmbyname(): Response
    {
        $movieAppDto = new MovieApiDto();
        //Remplacer par page
        $categorie = $movieAppDto->getCategories();
        return $this->render('films/index.html.twig', [
            'controller_name' => 'FilmsController',
            'categorie' => $categorie,
            'controller' => $movieAppDto,
        ]);
    }
    #[Route('/testpage/{idCategory}', name: 'test')]
    public function tester($idCategory): Response
    {
        $recherche = new RechercheDto();
        $form = $this->createForm(RechercheType::class,$recherche);

        $movieAppDto = new MovieApiDto();
        $filmCategories = $movieAppDto->getFilmByCategoryId($idCategory,20);
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'Accueil Controller',
            'form' => $form,
            'movies' => $filmCategories,
        ]);
    }
}
