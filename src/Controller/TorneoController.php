<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TorneoController extends AbstractController
{
    #[Route('/torneo', name: 'app_torneo')]
    public function index(): Response
    {
        
        return $this->render('torneo/index.html.twig', [
            'torneos' => 'TorneoController',
        ]);
    }

    #[Route('/torneo/nuevo', name: 'app_torneo_nuevo')]
    public function nuevo(): Response
    {
        return $this->render('torneo/nuevo.html.twig', [
            'controller_name' => 'TorneoController',
        ]);
    }
}
