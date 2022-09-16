<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Event;
use App\Entity\User;
use App\Entity\Overlay;
use App\Entity\Meta;
use App\Entity\Player;
use App\Entity\Widgets;

use App\Form\EventType;
use App\Form\OverlayType;
use App\Form\MetaType;
use App\Form\PlayerType;
use App\Form\GameType;

use App\Service\WidgetsService;

use App\Repository\GameRepository;
use App\Repository\EventRepository;
use App\Repository\UserRepository;
use App\Repository\OverlayRepository;
use App\Repository\WidgetsRepository;
use App\Repository\MetaRepository;
use App\Repository\LibWidgetsRepository;
use App\Repository\PlayerRepository;
use App\Repository\TweetRepository;
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
            'overlays' => $overlayRepository->findByIdUser($this->getUser()->getId()),
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
            $overlay->setOverlayOwner($this->getUser());
            // Insère toutes les données dans la table overlays
            $overlayRepository->add($overlay);
            // $topbar = new Widgets();
            // $topbar->setWidgetName('Barre ')

            return $this->redirectToRoute('app_overlay_index', [], Response::HTTP_SEE_OTHER);

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
    public function show(Request $request, Overlay $overlay, WidgetsRepository $widgetsRepository, PlayerRepository $playerRepository, MetaRepository $metaRepository, LibWidgetsRepository $libWidgetsRepository, OverlayRepository $overlayRepository, WidgetsService $widgetsService, int $id): Response
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
        $bottombar_marquee_1 = null;
        $bottombar_marquee_2 = null;
        $bottombar_marquee_3 = null;
        $bottombar_marquee_4 = null;
        $tweet_hashtag = null;
        foreach ($metas as $key => $value) {
            if ($value->getMetaKey() == 'popup_text') {
                $popup = $value;
            } else if ($value->getMetaKey() == 'topbar_title') {
                $topbar_title = $value;
            } else if ($value->getMetaKey() == 'bottombar_marquee_1') {
                $bottombar_marquee_1 = $value;
            } else if ($value->getMetaKey() == 'bottombar_marquee_2') {
                $bottombar_marquee_2 = $value;
            } else if ($value->getMetaKey() == 'bottombar_marquee_3') {
                $bottombar_marquee_3 = $value;
            } else if ($value->getMetaKey() == 'bottombar_marquee_4') {
                $bottombar_marquee_4 = $value;
            } else if ($value->getMetaKey() == 'tweet_hashtag') {
                $tweet_hashtag = $value;
            }
        }


        // INFO: On créer les formulaires en renseignant OBLIGATOIREMENT un nom différent
        $form_popup = $this->get('form.factory')
            ->createNamedBuilder('popup_text', MetaType::class, $popup)->getForm();
        $form_topbar = $this->get('form.factory')
            ->createNamedBuilder('topbar_title', MetaType::class, $topbar_title)->getForm();
        $form_bottombar_marquee_1 = $this->get('form.factory')
            ->createNamedBuilder('bottombar_marquee_1', MetaType::class, $bottombar_marquee_1)->getForm();
        $form_bottombar_marquee_2 = $this->get('form.factory')
            ->createNamedBuilder('bottombar_marquee_2', MetaType::class, $bottombar_marquee_2)->getForm();
        $form_bottombar_marquee_3 = $this->get('form.factory')
            ->createNamedBuilder('bottombar_marquee_3', MetaType::class, $bottombar_marquee_3)->getForm();
        $form_bottombar_marquee_4 = $this->get('form.factory')
            ->createNamedBuilder('bottombar_marquee_4', MetaType::class, $bottombar_marquee_4)->getForm();
        $form_tweet_hashtag = $this->get('form.factory')
            ->createNamedBuilder('tweet_hashtag', MetaType::class, $tweet_hashtag)->getForm();


        // INFO: Création form currentEvent & currentGame
        $event = $overlay->getCurrentEvent() != null ? $overlay->getCurrentEvent() : new Event();
        $game = $event->getCurrentGame() != null ? $event->getCurrentGame() : new Game();
        $form_current_event = $this->get('form.factory')
            ->createNamedBuilder('currentEvent', OverlayType::class, $overlay)->getForm();
        $form_current_game = $this->get('form.factory')
            ->createNamedBuilder('currentGame', EventType::class, $event)->getForm();
        $form_current_map = $this->get('form.factory')
            ->createNamedBuilder('currentMap', GameType::class, $game)->getForm();

        // INFO: Création form pour player
        $game = $event->getCurrentGame() != null ? $event->getCurrentGame() : new Game();
        // Faire un select avec tous les players de l'équipe Alpha
        $playersAlpha = $game->getGameIdTeamAlpha() != null ? $game->getGameIdTeamAlpha()->getPlayers()->getValues() : [];
        // Faire un select avec tous les players de l'équipe Beta
        $playersBeta = $game->getGameIdTeamBeta() != null ? $game->getGameIdTeamBeta()->getPlayers()->getValues() : [];
        // Récupération du résultat de la sélection de joueurs
        $player = $request->query->get('player') ? $playerRepository->find($request->query->get('player')) : new Player();

        if ($player != null) {
            $form_player = $this->get('form.factory')
                ->createNamedBuilder('plplayerayerA', PlayerType::class, $player)->getForm();
        }


        if ($request->isMethod('POST')) {

            // INFO: Détecte quel form est soumis et l'enregistre en Request (1 request à la fois pour le même FormType)
            if ($request->request->get($form_popup->getName()) != null) {
                $form_popup->submit($request->request->get($form_popup->getName()));
            }
            if ($request->request->get($form_topbar->getName()) != null) {
                $form_topbar->submit($request->request->get($form_topbar->getName()));
            }
            if ($request->request->get($form_bottombar_marquee_1->getName()) != null) {
                $form_bottombar_marquee_1->submit($request->request->get($form_bottombar_marquee_1->getName()));
            }
            if ($request->request->get($form_bottombar_marquee_2->getName()) != null) {
                $form_bottombar_marquee_2->submit($request->request->get($form_bottombar_marquee_2->getName()));
            }
            if ($request->request->get($form_bottombar_marquee_3->getName()) != null) {
                $form_bottombar_marquee_3->submit($request->request->get($form_bottombar_marquee_3->getName()));
            }
            if ($request->request->get($form_bottombar_marquee_4->getName()) != null) {
                $form_bottombar_marquee_4->submit($request->request->get($form_bottombar_marquee_4->getName()));
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
            } else if ($form_bottombar_marquee_1->isSubmitted() && $form_bottombar_marquee_1->isValid() && $form_bottombar_marquee_1->get('MetaKey')->getData() === "bottombar_marquee_1") {
                $entityManager = $this->getDoctrine()->getManager();
                $bottombar_marquee_1->setMetaValue($form_bottombar_marquee_1->get('MetaValue')->getData());
                $entityManager->flush();
                $this->addFlash('success', 'OUAIS Bottombar !');
            } else if ($form_bottombar_marquee_2->isSubmitted() && $form_bottombar_marquee_2->isValid() && $form_bottombar_marquee_2->get('MetaKey')->getData() === "bottombar_marquee_2") {
                $entityManager = $this->getDoctrine()->getManager();
                $bottombar_marquee_2->setMetaValue($form_bottombar_marquee_2->get('MetaValue')->getData());
                $entityManager->flush();
                $this->addFlash('success', 'OUAIS Bottombar !');
            } else if ($form_bottombar_marquee_3->isSubmitted() && $form_bottombar_marquee_3->isValid() && $form_bottombar_marquee_3->get('MetaKey')->getData() === "bottombar_marquee_3") {
                $entityManager = $this->getDoctrine()->getManager();
                $bottombar_marquee_3->setMetaValue($form_bottombar_marquee_3->get('MetaValue')->getData());
                $entityManager->flush();
                $this->addFlash('success', 'OUAIS Bottombar !');
            } else if ($form_bottombar_marquee_4->isSubmitted() && $form_bottombar_marquee_4->isValid() && $form_bottombar_marquee_4->get('MetaKey')->getData() === "bottombar_marquee_4") {
                $entityManager = $this->getDoctrine()->getManager();
                $bottombar_marquee_4->setMetaValue($form_bottombar_marquee_4->get('MetaValue')->getData());
                $entityManager->flush();
                $this->addFlash('success', 'OUAIS Bottombar !');
            } else if ($form_tweet_hashtag->isSubmitted() && $form_tweet_hashtag->isValid() && $form_tweet_hashtag->get('MetaKey')->getData() === "tweet_hashtag") {
                $entityManager = $this->getDoctrine()->getManager();
                $tweet_hashtag->setMetaValue($form_tweet_hashtag->get('MetaValue')->getData());
                $entityManager->flush();
                $this->addFlash('success', 'OUAIS Hashtag tweet !');
            }

            // INFO: Handling du formCurrentEvent, formCurrentGame, formCurrentMap
            if ($request->request->get($form_current_event->getName()) != null) {
                $form_current_event->submit($request->request->get($form_current_event->getName()));
            }
            if ($request->request->get($form_current_game->getName()) != null) {
                $form_current_game->submit($request->request->get($form_current_game->getName()));
            }
            if ($request->request->get($form_current_map->getName()) != null) {
                $form_current_map->submit($request->request->get($form_current_map->getName()));
            }

            if ($form_current_event->isSubmitted() && $form_current_event->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $overlay->setCurrentEvent($form_current_event->get('currentEvent')->getData());
                $entityManager->flush();
                $this->addFlash('success', 'OUAIS currentEvent !');
            }
            if ($form_current_game->isSubmitted() && $form_current_game->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $event->setCurrentGame($form_current_game->get('currentGame')->getData());
                $entityManager->flush();
                $this->addFlash('success', 'OUAIS currentGame !');
            }
            if ($form_current_map->isSubmitted() && $form_current_map->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $event->getCurrentGame()->setCurrentMap($form_current_map->get('currentMap')->getData());
                $entityManager->flush();
                $this->addFlash('success', 'OUAIS currentMap !');
            }

            // INFO: Handling du formPlayer
            if ($player != null) {
                if ($request->request->get($form_player->getName()) != null) {
                    $form_player->submit($request->request->get($form_player->getName()));
                }
                if ($form_player->isSubmitted() && $form_player->isValid()) {
                    $entityManager = $this->getDoctrine()->getManager();
                    $player->setPlayerIdObsNinja($form_player->get('playerIdObsNinja')->getData());
                    $entityManager->flush();
                    $this->addFlash('success', 'OUAIS Player !');
                }
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
            'form_bottombar_marquee_1' => $form_bottombar_marquee_1->createView(),
            'form_bottombar_marquee_2' => $form_bottombar_marquee_2->createView(),
            'form_bottombar_marquee_3' => $form_bottombar_marquee_3->createView(),
            'form_bottombar_marquee_4' => $form_bottombar_marquee_4->createView(),
            'form_tweet_hashtag' => $form_tweet_hashtag->createView(),
            'form_current_event' => $form_current_event->createView(),
            'form_current_game' => $form_current_game->createView(),
            'form_current_map' => $form_current_map->createView(),
            'form_player' => $player != null ? $form_player->createView() : null,
            'playersAlpha' => $playersAlpha,
            'playersBeta' => $playersBeta,
            'player' => $player,
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
            $overlay->setOverlayOwner($this->getUser());
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
        if ($this->isCsrfTokenValid('delete' . $overlay->getId(), $request->request->get('_token'))) {
            $overlayRepository->remove($overlay);
        }

        return $this->redirectToRoute('app_overlay_index', [], Response::HTTP_SEE_OTHER);
    }



    /**
     * @Route("overlay/{id}/browsersource", name="app_overlay_show_browsersource", methods={"GET"})
     */
    public function showBrowsersource(WidgetsRepository $widgetsRepository, MetaRepository $MetaRepository, OverlayRepository $overlayRepository, GameRepository $gamesRepository, EventRepository $eventsRepository, TweetRepository $tweetRepository, int $id): Response
    {

        $idTweet = $MetaRepository->findTweetId($id)[0]->getMetaValue();
        $tweet = $tweetRepository->find($idTweet);
        // dd($tweet);
        
        return $this->render('overlay/browsersource.html.twig', [
            'overlay' => $overlayRepository->find($id),
            'widgets' => $widgetsRepository->findAllByOverlay($id),
            'metas' => $MetaRepository->findAllByOverlay($id),
            'tweet' => $tweet,
            'controller_name' => "Browsersource"
        ]);
    }
}
