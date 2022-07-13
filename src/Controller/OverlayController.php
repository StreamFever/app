<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Event;
use App\Entity\User;
use App\Entity\Overlay;
use App\Entity\Meta;

use App\Form\OverlayType;

use App\Service\WidgetsService;

use App\Repository\GameRepository;
use App\Repository\EventRepository;
use App\Repository\UserRepository;
use App\Repository\OverlayRepository;
use App\Repository\WidgetsRepository;
use App\Repository\MetaRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;


class OverlayController extends AbstractController
{
   /**
     * @Route("/admin/overlay", name="app_overlay_index", methods={"GET"})
     */
    public function index(OverlayRepository $overlayRepository): Response
    {
        $currentUser = $this->getUser();
        
        return $this->render('overlay/index.html.twig', [
            'overlays' => $overlayRepository->findAllByIdUser($currentUser->getId()),
            'controller_name' => "Overlay"
        ]);
    }

    /**
     * @Route("/admin/overlay/new", name="app_overlay_new", methods={"GET", "POST"})
     */
    public function new(Request $request, OverlayRepository $overlayRepository, MetaRepository $MetaRepository, ManagerRegistry $doctrine): Response
    {
        $em = $this->getDoctrine()->getManager();
        $overlay = new Overlay();
        $form = $this->createForm(OverlayType::class, $overlay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Insère toutes les données dans la table overlays
            $overlayRepository->add($overlay);
            
            return $this->redirectToRoute('app_overlay_index', [] , Response::HTTP_SEE_OTHER);

            $this->addFlash('success', 'L\'overlay a bien été crée !');
       
        }

        return $this->renderForm('overlay/new.html.twig', [
            'overlays' => $overlayRepository->findAll(),
            'overlay' => $overlay,
            'form' => $form,
            'controller_name' => "Overlay"
        ]);
    }


    /**
     * @Route("/admin/overlay/{id}", name="app_overlay_show", methods={"GET"})
     */
    public function show(Overlay $overlay, WidgetsRepository $widgetsRepository, MetaRepository $metaRepository, WidgetsService $widgetsService, int $id): Response
    {
        // $this->denyAccessUnlessGranted('OVERLAY_VIEW', $overlay);
        // $this->security->overlayAccess($id, $this->getUser()->getId());
        $widgets = $widgetsRepository->findAllByOverlay($id);
        $metas = $metaRepository->findAllByOverlay($id);
        return $this->render('overlay/panel.html.twig', [
            'overlay' => $overlay,
            'widgets' => $widgets,
            'metas' => $metas,
            'redmine_widgets' => $widgetsService->getJsonData('https://ticket.artaic.fr/projects/sa-prod/issues.json?set_filter=1&tracker_id=5')["issues"],
            'controller_name' => "Overlay"
        ]);
    }


    /**
     * @Route("/admin/overlay/{id}/edit", name="app_overlay_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Overlay $overlay, OverlayRepository $overlayRepository, ManagerRegistry $doctrine, WidgetsRepository $widgetsRepository, MetaRepository $metaRepository, int $id): Response
    {
        $this->denyAccessUnlessGranted('OVERLAY_EDIT', $overlay);
        $form = $this->createForm(OverlayType::class, $overlay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $overlayRepository->add($overlay);

            $this->addFlash('success', 'L\'overlay a bien été modifié !');

            
            return $this->redirectToRoute('app_overlay_index', [], Response::HTTP_SEE_OTHER);
        }

        $widgets = $widgetsRepository->findAllByOverlay($id);
        $metas = $metaRepository->findAllByOverlay($id);
        return $this->renderForm('overlay/edit.html.twig', [
            'overlays' => $overlayRepository->findAll(),
            'overlay' => $overlay,
            'widgets' => $widgets,
            'metas' => $metas,
            'form' => $form,
            'controller_name' => "Overlay"
        ]);
    }

    /**
     * @Route("/admin/overlay/{id}", name="app_overlay_delete", methods={"POST"})
     */
    public function delete(Request $request, Overlay $overlay, OverlayRepository $overlayRepository): Response
    {
        $this->denyAccessUnlessGranted('OVERLAY_DELETE', $overlay);
        if ($this->isCsrfTokenValid('delete'.$overlay->getId(), $request->request->get('_token'))) {
            $overlayRepository->remove($overlay);
        }

        return $this->redirectToRoute('app_overlay_index', [], Response::HTTP_SEE_OTHER);
    }



    /**
     * @Route("overlay/{id}/browsersource", name="app_overlay_show_browsersource", methods={"GET"})
     */
    public function showBrowsersource(WidgetsRepository $widgetsRepository, MetaRepository $MetaRepository, GameRepository $gamesRepository, EventRepository $eventsRepository, int $id): Response
    {

        //TODO: Remplacer les findAll() par findAllByUserId()
        return $this->render('overlay/browsersource.html.twig', [
            'games' => $gamesRepository->findAllCreatedByUserId($currentUser = $this->getUser()),
            'events' => $eventsRepository->findAll(),
            'widgets' => $widgetsRepository->findAllByOverlay($id),
            'metas' => $MetaRepository->findAllByOverlay($id),
            'controller_name' => "Browsersource"
        ]);
    }
}
