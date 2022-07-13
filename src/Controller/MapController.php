<?php

namespace App\Controller;

use App\Entity\Map;
use App\Form\MapType;
use App\Repository\MapRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\FileUploader;

/**
 * @Route("/admin/maps")
 */
class MapController extends AbstractController
{
    /**
     * @Route("/", name="app_map_index", methods={"GET"})
     */
    public function index(MapRepository $mapRepository): Response
    {
        return $this->render('map/index.html.twig', [
            'maps' => $mapRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_map_new", methods={"GET", "POST"})
     */
    public function new(Request $request, FileUploader $fileUploader, MapRepository $mapRepository): Response
    {
        $map = new Map();
        $form = $this->createForm(MapType::class, $map);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            /** @var UploadedFile $logoFile */
            $logoFile = $form->get('mapImg')->getData();
            if ($logoFile) {
                $logoFileName = $fileUploader->uploadMap($logoFile);
                $data->setEventLogo($logoFileName);
            }

            $mapRepository->add($map);
            $this->addFlash('success', 'La carte a bien été créée !');
            return $this->redirectToRoute('app_map_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('map/new.html.twig', [
            'map' => $map,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_map_show", methods={"GET"})
     */
    public function show(Map $map): Response
    {
        return $this->render('map/show.html.twig', [
            'map' => $map,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_map_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, FileUploader $fileUploader, Map $map, MapRepository $mapRepository): Response
    {
        $form = $this->createForm(MapType::class, $map);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            /** @var UploadedFile $logoFile */
            $logoFile = $form->get('mapImg')->getData();
            if ($logoFile) {
                $logoFileName = $fileUploader->uploadMap($logoFile);
                $data->setMapImg($logoFileName);
            }

            $mapRepository->add($map);

            $this->addFlash('success', 'La carte a bien été modifiée !');

            return $this->redirectToRoute('app_map_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('map/edit.html.twig', [
            'map' => $map,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_map_delete", methods={"POST"})
     */
    public function delete(Request $request, Map $map, MapRepository $mapRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$map->getId(), $request->request->get('_token'))) {
            $mapRepository->remove($map);
        }

        return $this->redirectToRoute('app_map_index', [], Response::HTTP_SEE_OTHER);
    }
}
