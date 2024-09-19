<?php

namespace App\Controller;

use App\Entity\Genero;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/genero')]
class GeneroController extends AbstractController
{
    #[Route('/', name: 'app_genero')]
    public function index(): Response
    {
        return $this->render('genero/index.html.twig', [
            'controller_name' => 'GeneroController',
        ]);
    }

    #[Route('/nuevo', name: 'app_genero_nuevo', methods: ['GET', 'POST'])]
    public function nuevo(Request $request, EntityManagerInterface $entityManager ): Response
    {
        if ($request->isMethod('POST')) {
            
            $genero = new Genero();
            $genero->setNombre($request->request->get('nombre'));
            
            $entityManager->persist($genero);
            $entityManager->flush();

            return $this->redirectToRoute('app_genero', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('genero/nuevo.html.twig', [
            'controller_name' => 'GeneroController',
        ]);
    }
}
