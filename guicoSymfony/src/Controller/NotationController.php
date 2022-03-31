<?php

namespace App\Controller;

use App\Entity\Films;
use App\Entity\ListeFilms;
use App\Entity\Note;
use App\Repository\FilmsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NotationController extends AbstractController
{
    #[Route('/notation/{id}', name: 'notation', methods: ['GET'])]
    public function index($id): Response
    {
        $film = new ListeFilms();
        return $this->render('notation/index.html.twig', [
            'controller_name' => 'NotationController',
            'unFilm' => $film,
            'unFilmID' => $id,
        ]);
    }

//    /**
//     *
//     * @Route("/notation/addNote/{id}/{note}", name="AddNOTE")
//     */
    #[Route('notation/addNote/{id}/{note}', name: 'AddNOTE')]
    public function addNote($id, int $note, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if(!$user == null){
            $newnote = new Note();
            $newnote->setIdUser($user);
            $newnote->setIdFilm($id);
            $newnote->setNote($note);
            $entityManager->persist($newnote);
            $entityManager->flush();
            return $this->redirectToRoute('films', [
                'page' => 1,
            ]);
        }
        return $this->redirectToRoute('notation');
    }
}
