<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Event;
use App\Entity\User;
use App\Entity\Overlay;
use App\Entity\Meta;
use App\Entity\Widgets;

use App\Form\OverlayType;
use App\Form\MetaType;

use App\Service\WidgetsService;
use App\Service\MetasService;

use App\Repository\GameRepository;
use App\Repository\EventRepository;
use App\Repository\UserRepository;
use App\Repository\OverlayRepository;
use App\Repository\WidgetsRepository;
use App\Repository\MetaRepository;
use App\Repository\LibWidgetsRepository;

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
            'overlays' => $overlayRepository->findByIdUser($currentUser->getId()),
            'controller_name' => "Overlay"
        ]);
    }

    /**
     * @Route("/admin/overlay/new", name="app_overlay_new", methods={"GET", "POST"})
     */
    public function new(Request $request, OverlayRepository $overlayRepository, MetaRepository $MetaRepository, WidgetsRepository $widgetsRepository, ManagerRegistry $doctrine): Response
    {
        $em = $this->getDoctrine()->getManager();
        $overlay = new Overlay();
        $form = $this->createForm(OverlayType::class, $overlay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Insère toutes les données dans la table overlays
            $overlayRepository->add($overlay);
            // $topbar = new Widgets();
            // $topbar->setWidgetName('Barre ')
            
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
     * @Route("/admin/overlay/{id}", name="app_overlay_show", methods={"GET", "POST"})
     */
    public function show(Request $request, Overlay $overlay, WidgetsRepository $widgetsRepository, MetaRepository $metaRepository, LibWidgetsRepository $libWidgetsRepository, OverlayRepository $overlayRepository, WidgetsService $widgetsService, MetasService $metasService, int $id): Response
    {
        // $this->denyAccessUnlessGranted('OVERLAY_VIEW', $overlay);
        // $this->security->overlayAccess($id, $this->getUser()->getId());
        $widgets = $widgetsRepository->findAllByOverlay($id);
        $metas = $metaRepository->findAllByOverlay($id);

            // INFO: On récupère individuellement les métas de l'overlay
        // $popup = $metaRepository->findOneBy(['MetaKey' => 'popup_text', 'Widgets' => $widgetsRepository->findOneBy(['WidgetId' => $libWidgetsRepository->findOneBy(['libWidgetId' => 'popup_text'])->getId(),'overlay' => $id])]);
        // $topbar_title = $metaRepository->findOneBy(['MetaKey' => 'topbar_title', 'Widgets' => $widgetsRepository->findOneBy(['WidgetId' => $libWidgetsRepository->findOneBy(['libWidgetId' => 'topbar'])->getId(),'overlay' => $id])]);
        // $bottombar_marquee = $metaRepository->findOneBy(['MetaKey' => 'bottombar_marquee', 'Widgets' => $widgetsRepository->findOneBy(['WidgetId' => $libWidgetsRepository->findOneBy(['libWidgetId2' => 'bottombar'])->getId(),'overlay' => $id])]);
        // $tweet_hashtag = $metaRepository->findOneBy(['MetaKey' => 'tweet_hashtag', 'Widgets' => $widgetsRepository->findOneBy(['WidgetId' => $libWidgetsRepository->findOneBy(['libWidgetId' => 'tweets'])->getId(),'overlay' => $id])]);
        $popup = null;
        $topbar_title = null;
        $bottombar_marquee = null;
        $tweet_hashtag = null;
        foreach ($metas as $key => $value) {
            if ($value->getMetaKey() == 'popup_text') {
                $popup = $value;
            } else if ($value->getMetaKey() == 'topbar_title') {
                $topbar_title = $value;
            } else if ($value->getMetaKey() == 'bottombar_marquee') {
                $bottombar_marquee = $value;
            } else if ($value->getMetaKey() == 'tweet_hashtag') {
                $tweet_hashtag = $value;
            }
        }     
        

        // INFO: On créer les formulaires en renseignant OBLIGATOIREMENT un nom différent
        $form_popup = $this->get('form.factory')
        ->createNamedBuilder('popup_text', MetaType::class, $popup)->getForm();
        $form_topbar = $this->get('form.factory')
        ->createNamedBuilder('topbar_title', MetaType::class, $topbar_title)->getForm();
        $form_bottombar_marquee = $this->get('form.factory')
        ->createNamedBuilder('bottombar_marquee', MetaType::class, $bottombar_marquee)->getForm();
        $form_tweet_hashtag = $this->get('form.factory')
        ->createNamedBuilder('tweet_hashtag', MetaType::class, $tweet_hashtag)->getForm();
        

        if ($request->isMethod('POST')) {

            // INFO: Détecte quel form est soumis et l'enregistre en Request (1 request à la fois pour le même FormType)
            if ($request->request->get($form_popup->getName()) != null) {
                $form_popup->submit($request->request->get($form_popup->getName()));
            }
            if ($request->request->get($form_topbar->getName()) != null) {
                $form_topbar->submit($request->request->get($form_topbar->getName()));
            }
            if ($request->request->get($form_bottombar_marquee->getName()) != null) {
                $form_bottombar_marquee->submit($request->request->get($form_bottombar_marquee->getName()));
            }
            if ($request->request->get($form_tweet_hashtag->getName()) != null) {
                $form_tweet_hashtag->submit($request->request->get($form_tweet_hashtag->getName()));
            }
            

            // INFO: Si c'est submit et validé, on enregistre les nouvelles données dans la table metas selon la property MetaKey
            if ($form_popup->isSubmitted() && $form_popup->isValid() && $form_popup->get('MetaKey')->getData() === "popup_text") {
                $entityManager = $this->getDoctrine()->getManager();
                $popup->setMetaValue($form_popup->get('MetaValue')->getData());
                $entityManager->flush();
                $this->addFlash('success', 'OUAIS Popup !');
            } else if ($form_topbar->isSubmitted() && $form_topbar->isValid() && $form_topbar->get('MetaKey')->getData() === "topbar_title") {
                $entityManager = $this->getDoctrine()->getManager();
                $topbar_title->setMetaValue($form_topbar->get('MetaValue')->getData());
                $entityManager->flush();
                $this->addFlash('success', 'OUAIS Topbar !');
            } else if ($form_bottombar_marquee->isSubmitted() && $form_bottombar_marquee->isValid() && $form_bottombar_marquee->get('MetaKey')->getData() === "bottombar_marquee") {
                $entityManager = $this->getDoctrine()->getManager();
                $bottombar_marquee->setMetaValue($form_bottombar_marquee->get('MetaValue')->getData());
                $entityManager->flush();
                $this->addFlash('success', 'OUAIS Bottombar !');
            } else if ($form_tweet_hashtag->isSubmitted() && $form_tweet_hashtag->isValid() && $form_tweet_hashtag->get('MetaKey')->getData() === "tweet_hashtag") {
                $entityManager = $this->getDoctrine()->getManager();
                $tweet_hashtag->setMetaValue($form_tweet_hashtag->get('MetaValue')->getData());
                $entityManager->flush();
                $this->addFlash('success', 'OUAIS Hashtag tweet !');
            }
            

        }

        return $this->render('overlay/panel.html.twig', [
            'overlay' => $overlay,
            'widgets' => $widgets,
            'metas' => $metas,
            'redmine_widgets' => $widgetsService->getJsonData('https://ticket.artaic.fr/projects/sa-prod/issues.json?set_filter=1&tracker_id=5')["issues"],
            'controller_name' => "Overlay",
            'form_topbar' => $form_topbar->createView(),
            'form_popup' => $form_popup->createView(),
            'form_bottombar_marquee' => $form_bottombar_marquee->createView(),
            'form_tweet_hashtag' => $form_tweet_hashtag->createView(),
            // 'detail_form' => $form_popup->getName(),
            // 'detail_form2' => $form_topbar->getName(),
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
