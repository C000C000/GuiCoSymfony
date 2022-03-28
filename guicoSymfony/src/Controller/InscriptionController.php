<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'inscription', methods: ["GET", "POST"])]
    public function index(Request $request, EntityManagerInterface $entityManagerInterface, UserPasswordHasherInterface $passwordHasher): Response
    {
        $task = new User();
        $form = $this->createForm(InscriptionType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {



            $task = $form->getData();

            $plaintextPassword = $task->getPassword();
            $hashedPassword = $passwordHasher->hashPassword(
                $task,
                $plaintextPassword
            );

            $task->setNom($task->getNom());
            $task->setPrenom($task->getPrenom());
            $task->setMail($task->getMail());
            $task->setAge($task->getAge());
            $task->setMotDePasse($hashedPassword);
            $task->setRole('ROLE_USER');

            $entityManagerInterface->persist($task);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('connexion');
        }

        return $this->render('inscription/index.html.twig', ['form' => $form->createView()
        ]);


        /*return $this->render('inscription/index.html.twig', [
            'controller_name' => 'InscriptionController',
        ]);*/
    }
}
