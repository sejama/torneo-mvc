<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Entity\Genero;
use App\Entity\Torneo;
use App\Repository\TorneoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/torneo')]
class TorneoController extends AbstractController
{
    #[Route('/', name: 'app_torneo')]
    public function index(TorneoRepository $torneoRepository): Response
    {
        $torneos = $torneoRepository->findAllByUsuario($this->getUser()->getId());
        return $this->render('torneo/index.html.twig', [
            'torneos' => $torneos,
        ]);
    }

    #[Route('/detalle/{ruta}', name: 'app_torneo_detalle', methods: ['GET'])]
    public function detalle(TorneoRepository $torneoRepository, $ruta): Response
    {
        $torneo = $torneoRepository->findOneByRuta($ruta);

        return $this->render('torneo/detalle.html.twig', [
            'torneo' => $torneo,
        ]);
    }

    #[Route('/nuevo', name: 'app_torneo_nuevo', methods: ['GET', 'POST'])]
    public function nuevo(Request $request, EntityManagerInterface $entityManager): Response
    {   
        $generos = $entityManager->getRepository(Genero::class)->findAll();
        if ($request->isMethod('POST')) {

            $torneo = new Torneo();
            $torneo->setNombre($request->request->get('nombre'));
            $torneo->setRuta($request->request->get('ruta'));
            $torneo->setDescripcion($request->request->get('descripcion'));
            $torneo->setFechaInicioTorneo(new \DateTimeImmutable($request->request->get('fechaInicioTorneo'). ' ' .$request->request->get('horaInicioTorneo')));
            $torneo->setFechaFinTorneo(new \DateTimeImmutable($request->request->get('fechaFinTorneo'). ' ' .$request->request->get('horaFinTorneo')));
            $torneo->setFechaInicioInscripcion(new \DateTimeImmutable($request->request->get('fechaInicioInscripcion'). ' ' .$request->request->get('horaInicioInscripcion')));
            $torneo->setFechaFinInscripcion(new \DateTimeImmutable($request->request->get('fechaFinInscripcion'). ' ' .$request->request->get('horaFinInscripcion')));
            $torneo->setUsuario($this->getUser());
            
            $entityManager->persist($torneo);
            
            $entityManager->flush();

            $categorias = $request->request->all('categorias');

            foreach ($categorias as $categoriaInput) {
                $categoria = new Categoria();
                $categoria->setTorneo($torneo);
                $categoria->setGenero($entityManager->getRepository(Genero::class)->find((int)$categoriaInput['generoId']));
                $categoria->setNombre($categoriaInput['categoriaNombre']);
                $entityManager->persist($categoria);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_torneo', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('torneo/nuevo.html.twig', [
            'generos' => $generos,
        ]);
    }

    #[Route('/editar/{id}', name: 'app_torneo_editar')]
    public function editar(): Response
    {
        return $this->render('torneo/editar.html.twig', [
            'controller_name' => 'TorneoController',
        ]);
    }

    #[Route('/eliminar/{id}', name: 'app_torneo_eliminar')]
    public function eliminar(): Response
    {
        return $this->render('torneo/eliminar.html.twig', [
            'controller_name' => 'TorneoController',
        ]);
    }
}
