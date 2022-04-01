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
        if(!$user == null) {
            $films = $listeFilmsRepository->getFilms($user->getId());
            return $this->render('watch_list/index.html.twig', [
                'controller_name' => 'WatchListController',
                'films' => $films,
                'controller' => $dto,
            ]);
        }else{
            return $this->redirectToRoute('films', ['page'=>1]);
        }
    }



    /**
     *
     * @Route("/WatchList/add/{id}", name="WatchList")
     */
    public function add($id,EntityManagerInterface $entityManagerInterface, ListeFilmsRepository $listeFilmsRepository){

        /** @var User $user */
        $user = $this->getUser();
        $liste = new ListeFilms();

        $liste->setIdUser($user);
        $liste->setIdFilm($id);
        if(!$user == null){
            $films = $listeFilmsRepository->getFilms($user->getId());
            foreach($films as $film){
                //DD($id);
                if($film->getIdFilm() === intval($id)){
                    echo "<script>
                            alert(\"Ce film est déjà présent dans votre liste.\")
                        </script>";
                    return $this->redirectToRoute('redirect');
                }
            }
            //Sinon si on a pas eu le render avant
            $entityManagerInterface->persist($liste);
            $entityManagerInterface->flush();
            return $this->redirectToRoute('watch_list');
        }else{
            //return nouvelle page qui demande à l'utilisateur de se connecter
            //Pour afficher ses films
            return $this->redirectToRoute('films');
        }


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
