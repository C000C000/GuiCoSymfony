<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\UserSimpleType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/crud/user')]
class CrudUserController extends AbstractController
{
    #[Route('/list', name: 'app_crud_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('crud_user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_crud_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $plaintextPassword = $user->getPassword();
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setNom($user->getNom());
            $user->setPrenom($user->getPrenom());
            $user->setMail($user->getMail());
            $user->setAge($user->getAge());
            $user->setMotDePasse($hashedPassword);
            $user->setRole('ROLE_USER');


            $userRepository->add($user);
            return $this->redirectToRoute('app_crud_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud_user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/edit', name: 'app_crud_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if($user->getRole() === 'ROLE_USER'){
            $form = $this->createForm(UserSimpleType::class, $user);
            $form->handleRequest($request);
        }else{
            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);
        }


        if ($form->isSubmitted() && $form->isValid()) {

            $plaintextPassword = $user->getPassword();
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );

            $user->setNom($user->getNom());
            $user->setPrenom($user->getPrenom());
            $user->setMail($user->getMail());
            $user->setAge($user->getAge());
            $user->setMotDePasse($hashedPassword);
            $user->setRole('ROLE_USER');

            $userRepository->add($user);
            return $this->redirectToRoute('app_crud_user_show', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud_user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('', name: 'app_crud_user_show', methods: ['GET'])]
    public function show(): Response
    {

        return $this->render('crud_user/show.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    #[Route('/{id}', name: 'app_crud_user_delete', methods: ['POST'])]
    public function delete(Request $request, UserRepository $userRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user);
        }

        return $this->redirectToRoute('accueil', [], Response::HTTP_SEE_OTHER);
    }
}
