<?php

namespace App\Controller;

use App\Dto\unLogin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ConnexionController extends AbstractController
{
    #[Route('/connexion', name: 'connexion', methods: ['GET','POST'])]
    public function index(Request $request, AuthenticationUtils $authenticationUtils): Response
    {

        $errors = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

            return $this->render('connexion/index.html.twig', [
                'errors'=>$errors,
                'last_username'=>$lastUsername
            ]);

        /*return $this->render('connexion/index.html.twig', [
            'controller_name' => 'ConnexionController',
        ]);*/


    }

    #[Route('/logout', name: 'logout')]     //Permet une déconnexion
    public function logout(){

    }
}
