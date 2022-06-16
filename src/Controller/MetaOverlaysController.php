<?php

namespace App\Controller;

use App\Entity\MetaOverlays;
use App\Form\MetaOverlaysType;
use App\Repository\MetaOverlaysRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/overlay/meta")
 */
class MetaOverlaysController extends AbstractController
{
    /**
     * @Route("/", name="app_meta_overlays_index", methods={"GET"})
     */
    public function index(MetaOverlaysRepository $metaOverlaysRepository): Response
    {
        return $this->render('meta_overlays/index.html.twig', [
            'meta_overlays' => $metaOverlaysRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_meta_overlays_new", methods={"GET", "POST"})
     */
    public function new(Request $request, MetaOverlaysRepository $metaOverlaysRepository): Response
    {
        $metaOverlay = new MetaOverlays();
        $form = $this->createForm(MetaOverlaysType::class, $metaOverlay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $metaOverlaysRepository->add($metaOverlay);
            return $this->redirectToRoute('app_meta_overlays_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('meta_overlays/new.html.twig', [
            'meta_overlay' => $metaOverlay,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_meta_overlays_show", methods={"GET"})
     */
    public function show(MetaOverlays $metaOverlay): Response
    {
        return $this->render('meta_overlays/show.html.twig', [
            'meta_overlay' => $metaOverlay,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_meta_overlays_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, MetaOverlays $metaOverlay, MetaOverlaysRepository $metaOverlaysRepository): Response
    {
        $form = $this->createForm(MetaOverlaysType::class, $metaOverlay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $metaOverlaysRepository->add($metaOverlay);
            return $this->redirectToRoute('app_meta_overlays_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('meta_overlays/edit.html.twig', [
            'meta_overlay' => $metaOverlay,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_meta_overlays_delete", methods={"POST"})
     */
    public function delete(Request $request, MetaOverlays $metaOverlay, MetaOverlaysRepository $metaOverlaysRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$metaOverlay->getId(), $request->request->get('_token'))) {
            $metaOverlaysRepository->remove($metaOverlay);
        }

        return $this->redirectToRoute('app_meta_overlays_index', [], Response::HTTP_SEE_OTHER);
    }
}
