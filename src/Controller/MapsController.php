<?php

namespace App\Controller;

use App\Entity\Maps;
use App\Form\MapsType;
use App\Repository\MapsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/maps")
 */
class MapsController extends AbstractController
{
    /**
     * @Route("/", name="app_maps_index", methods={"GET"})
     */
    public function index(MapsRepository $mapsRepository): Response
    {
        return $this->render('maps/index.html.twig', [
            'maps' => $mapsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_maps_new", methods={"GET", "POST"})
     */
    public function new(Request $request, MapsRepository $mapsRepository): Response
    {
        $map = new Maps();
        $form = $this->createForm(MapsType::class, $map);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mapsRepository->add($map);
            return $this->redirectToRoute('app_maps_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('maps/new.html.twig', [
            'map' => $map,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_maps_show", methods={"GET"})
     */
    public function show(Maps $map): Response
    {
        return $this->render('maps/show.html.twig', [
            'map' => $map,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_maps_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Maps $map, MapsRepository $mapsRepository): Response
    {
        $form = $this->createForm(MapsType::class, $map);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mapsRepository->add($map);
            return $this->redirectToRoute('app_maps_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('maps/edit.html.twig', [
            'map' => $map,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_maps_delete", methods={"POST"})
     */
    public function delete(Request $request, Maps $map, MapsRepository $mapsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$map->getId(), $request->request->get('_token'))) {
            $mapsRepository->remove($map);
        }

        return $this->redirectToRoute('app_maps_index', [], Response::HTTP_SEE_OTHER);
    }
}
