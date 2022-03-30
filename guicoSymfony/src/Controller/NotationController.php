<?php

namespace App\Controller;

use App\Entity\Films;
use App\Entity\ListeFilms;
use App\Entity\Note;
use App\Repository\FilmsRepository;
use App\Repository\UserRepository;
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
    public function addNote($id, int $note, ManagerRegistry $managerRegistry): Response
    {
        $user = $this->getUser();
        if(!$user == null){
            $entityManager = $managerRegistry->getManager();
            $avisRepo = $managerRegistry->getRepository(Note::class);
            $note = new Note();
            $note->setIdUser($user->getId());
            $note->setIdFilm($id);
            $note->setNote((int)$note);
            $entityManager->persist($note);
            $entityManager->flush();
            return $this->redirectToRoute('films');
        }
        return $this->redirectToRoute('notation');
    }
}
