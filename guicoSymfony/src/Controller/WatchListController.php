<?php

namespace App\Controller;

use App\Entity\Liste;
use App\Entity\ListeFilms;
use App\Entity\User;
use App\Repository\ListeFilmsRepository;
use Doctrine\ORM\EntityManagerInterface;
use MovieApiDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WatchListController extends AbstractController
{

    #[Route('/watch/list', name: 'watch_list')]
    public function index(ListeFilmsRepository $listeFilmsRepository): Response
    {
        $user = $this->getUser();
        $dto = new MovieApiDto();
        $films = $listeFilmsRepository->getFilms($user->getId());
        return $this->render('watch_list/index.html.twig', [
            'controller_name' => 'WatchListController',
            'films' => $films,
            'controller'=>$dto,
        ]);
    }



    /**
     *
     * @Route("/WatchList/add/{id}", name="WatchList")
     */
    public function add($id,EntityManagerInterface $entityManagerInterface, ListeFilmsRepository $listeFilmsRepository){

        /** @var User $user */
        $user = $this->getUser();
        $liste = new ListeFilms();
        $dto = new MovieApiDto();

        $mesFilms = array();
        $liste->setIdUser($user);
        //DD($id);
        $liste->setIdFilm($id);

        $films = $listeFilmsRepository->getFilms($user->getId());

        foreach($films as $film){
            //DD($id);
            if($film->getIdFilm() === intval($id)){
                DD("Ce film existe déjà dans votre liste.");

            }
        }
        //Sinon si on a pas eu le render avant
        $entityManagerInterface->persist($liste);
        $entityManagerInterface->flush();
        return $this->redirectToRoute('watch_list');
    }

    /**
     *
     * @Route("/WatchList/remove/{id}", name="WatchListRemove")
     */
    public function remove($id,EntityManagerInterface $entityManagerInterface, ListeFilmsRepository $listeFilmsRepository){
        $user = $this->getUser();
        //$listeFilmsRepository->find($id);

        //$user->removeListeFilm($listeFilmsRepository->find($id));
        $listeFilmsRepository->delFilm($user->getId(), $id);
        //DD($user);
        return $this->redirectToRoute('watch_list');
    }
}
