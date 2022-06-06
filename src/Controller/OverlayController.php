<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Overlay;
use App\Form\OverlayType;
use App\Repository\OverlayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OverlayController extends AbstractController
{
    /**
     * @Route("admin/overlay", name="app_overlay_index", methods={"GET"})
     */
    public function index(OverlayRepository $overlayRepository): Response
    {
        return $this->render('overlay/index.html.twig', [
            'overlays' => $overlayRepository->findAll(),
            'controller_name' => "Overlay"
        ]);
    }

    /**
     * @Route("admin/overlay/new", name="app_overlay_new", methods={"GET", "POST"})
     */
    public function new(Request $request, OverlayRepository $overlayRepository): Response
    {
        $overlay = new Overlay();
        $form = $this->createForm(OverlayType::class, $overlay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $overlayRepository->add($overlay);
            return $this->redirectToRoute('app_overlay_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('overlay/new.html.twig', [
            'overlays' => $overlayRepository->findAll(),
            'overlay' => $overlay,
            'form' => $form,
            'controller_name' => "Overlay"
        ]);
    }


    /**
     * @Route("admin/overlay/{id}", name="app_overlay_show", methods={"GET"})
     */
    public function show(OverlayRepository $overlayRepository, Overlay $overlay, User $user): Response
    {
        return $this->render('overlay/show.html.twig', [
            'overlays' => $overlayRepository->findAll(),
            'overlay' => $overlay,
            'user' =>$user,
            'controller_name' => "Overlay"
        ]);
    }

    /**
     * @Route("admin/overlay/{id}/edit", name="app_overlay_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Overlay $overlay, OverlayRepository $overlayRepository): Response
    {
        $form = $this->createForm(OverlayType::class, $overlay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $overlayRepository->add($overlay);
            return $this->redirectToRoute('app_overlay_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('overlay/edit.html.twig', [
            'overlays' => $overlayRepository->findAll(),
            'overlay' => $overlay,
            'form' => $form,
            'controller_name' => "Overlay"
        ]);
    }

    /**
     * @Route("admin/overlay/{id}", name="app_overlay_delete", methods={"POST"})
     */
    public function delete(Request $request, Overlay $overlay, OverlayRepository $overlayRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$overlay->getId(), $request->request->get('_token'))) {
            $overlayRepository->remove($overlay);
        }

        return $this->redirectToRoute('app_overlay_index', [], Response::HTTP_SEE_OTHER);
    }



    /**
     * @Route("overlay/{user_id}/browsersource", name="app_overlay_show_browsersource", methods={"GET"})
     */
    public function showBrowsersource(OverlayRepository $overlayRepository, int $user_id): Response
    {
        return $this->render('overlay/browsersource.html.twig', [
            'overlays' => $overlayRepository->findAllByIdUser($user_id),
            'controller_name' => "Browsersource"
        ]);
    }

    /**
     * @Route("admin/overlay/u/{user_id}", name="app_overlay_show_by_iduser", methods={"GET"})
     */
    public function showByIdUser(OverlayRepository $overlayRepository, int $user_id): Response
    {
        return $this->render('overlay/u/show.html.twig', [
            'overlays' => $overlayRepository->findAllByIdUser($user_id),
            'controller_name' => "Overlay"
        ]);
    }
}
