<?php

namespace App\Controller;

use App\Entity\Genero;
use App\Repository\GeneroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/genero')]
class GeneroController extends AbstractController
{
    #[Route('/', name: 'app_genero', methods: ['GET'])]
    public function index(GeneroRepository $generoRepository): Response
    {
        $generos = $generoRepository->findAll();
        return $this->render('genero/index.html.twig', [
            'generos' => $generos,
        ]);
    }

    #[Route('/detalle/{id}', name: 'app_genero_detalle', methods: ['GET'])]
    public function detalle(Genero $genero): Response
    {
        return $this->render('genero/detalle.html.twig', [
            'genero' => $genero,
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

    #[Route('/editar/{id}', name: 'app_genero_editar', methods: ['GET', 'POST'])]
    public function editar(Genero $genero, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            $genero->setNombre($request->request->get('nombre'));
            $entityManager->flush();

            return $this->redirectToRoute('app_genero', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('genero/editar.html.twig', [
            'genero' => $genero,
        ]);
    }

    #[Route('/eliminar/{id}', name: 'app_genero_eliminar', methods: ['GET'])]
    public function eliminar(Genero $genero, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($genero);
        $entityManager->flush();

        return $this->redirectToRoute('app_genero', [], Response::HTTP_SEE_OTHER);
    }
}
