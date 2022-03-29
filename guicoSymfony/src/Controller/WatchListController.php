<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WatchListController extends AbstractController
{
    #[Route('/watch/list', name: 'watch_list')]
    public function index(): Response
    {
        return $this->render('watch_list/index.html.twig', [
            'controller_name' => 'WatchListController',
        ]);
    }
}
