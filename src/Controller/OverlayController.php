<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Overlay;
use App\Entity\MetaOverlays;
use App\Form\OverlayType;
use App\Repository\OverlayRepository;
use App\Repository\MetaOverlaysRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

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
    public function new(Request $request, OverlayRepository $overlayRepository, MetaOverlaysRepository $metaOverlaysRepository, ManagerRegistry $doctrine): Response
    {
        $em = $this->getDoctrine()->getManager();
        $overlay = new Overlay();
        $form = $this->createForm(OverlayType::class, $overlay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // Insère toutes les données dans la table overlays
            $overlayRepository->add($overlay);
            
            if ($data->getWidgetIdAlpha() == "topbar" || $data->getWidgetIdBeta() == "topbar") {
                // Insère les données suivantes dans la table meta_overlays si nécessaire
                // DOCS: https://symfony.com/doc/current/doctrine/associations.html
                $meta = new MetaOverlays();
                $meta->setMetaKey('topbar_title');
                $meta->setMetaValue("");

                
                // relates this product to the category
                $overlay->addMetaOverlay($meta);

                $entityManager = $doctrine->getManager();
                $entityManager->persist($meta);
                $entityManager->persist($overlay);
                $entityManager->flush();
            }
            if ($data->getWidgetIdAlpha() == "bottombar" || $data->getWidgetIdBeta() == "bottombar") {
                // Insère les données suivantes dans la table meta_overlays si nécessaire
                // DOCS: https://symfony.com/doc/current/doctrine/associations.html
                $meta = new MetaOverlays();
                $meta->setMetaKey('bottombar_marquee');
                $meta->setMetaValue("");

                
                // relates this product to the category
                $overlay->addMetaOverlay($meta);

                $entityManager = $doctrine->getManager();
                $entityManager->persist($meta);
                $entityManager->persist($overlay);
                $entityManager->flush();
            }
            if ($data->getWidgetIdAlpha() == "popup_text" || $data->getWidgetIdBeta() == "popup_text") {
                // Insère les données suivantes dans la table meta_overlays si nécessaire
                // DOCS: https://symfony.com/doc/current/doctrine/associations.html
                $meta = new MetaOverlays();
                $meta->setMetaKey('popup_text');
                $meta->setMetaValue("");

                
                // relates this product to the category
                $overlay->addMetaOverlay($meta);

                $entityManager = $doctrine->getManager();
                $entityManager->persist($meta);
                $entityManager->persist($overlay);
                $entityManager->flush();
            }
            if ($data->getWidgetIdAlpha() == "cam_heros" || $data->getWidgetIdBeta() == "cam_heros" || $data->getWidgetIdAlpha() == "cam_tournoi" || $data->getWidgetIdBeta() == "cam_tournoi") {
                for ($i=0; $i < 5; $i++) { 
                    // Insère les données suivantes dans la table meta_overlays si nécessaire
                    // DOCS: https://symfony.com/doc/current/doctrine/associations.html
                    $meta = new MetaOverlays();
                    $meta->setMetaKey('id_cam_obsninja_'.$i);
                    $meta->setMetaValue("");

                    
                    // relates this product to the category
                    $overlay->addMetaOverlay($meta);

                    $entityManager = $doctrine->getManager();
                    $entityManager->persist($meta);
                    $entityManager->persist($overlay);
                    $entityManager->flush();
                }
            }
            
            return $this->redirectToRoute('app_overlay_index', [] , Response::HTTP_SEE_OTHER);
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
    public function show(Overlay $overlay): Response
    {
        return $this->render('overlay/show.html.twig', [
            'overlay' => $overlay,
            'controller_name' => "Overlay"
        ]);
    }


    /**
     * @Route("admin/overlay/{id}/edit", name="app_overlay_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Overlay $overlay, OverlayRepository $overlayRepository, ManagerRegistry $doctrine): Response
    {
        $form = $this->createForm(OverlayType::class, $overlay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $overlayRepository->add($overlay);
            if ($data->getWidgetIdAlpha() == "topbar" || $data->getWidgetIdBeta() == "topbar") {
                // Insère les données suivantes dans la table meta_overlays si nécessaire
                // DOCS: https://symfony.com/doc/current/doctrine/associations.html
                $meta = new MetaOverlays();
                $meta->setMetaKey('topbar_title');
                $meta->setMetaValue("");

                
                // relates this product to the category
                $overlay->addMetaOverlay($meta);

                $entityManager = $doctrine->getManager();
                $entityManager->persist($meta);
                $entityManager->persist($overlay);
                $entityManager->flush();
            }
            if ($data->getWidgetIdAlpha() == "bottombar" || $data->getWidgetIdBeta() == "bottombar") {
                // Insère les données suivantes dans la table meta_overlays si nécessaire
                // DOCS: https://symfony.com/doc/current/doctrine/associations.html
                $meta = new MetaOverlays();
                $meta->setMetaKey('bottombar_marquee');
                $meta->setMetaValue("");

                
                // relates this product to the category
                $overlay->addMetaOverlay($meta);

                $entityManager = $doctrine->getManager();
                $entityManager->persist($meta);
                $entityManager->persist($overlay);
                $entityManager->flush();
            }
            if ($data->getWidgetIdAlpha() == "popup_text" || $data->getWidgetIdBeta() == "popup_text") {
                // Insère les données suivantes dans la table meta_overlays si nécessaire
                // DOCS: https://symfony.com/doc/current/doctrine/associations.html
                $meta = new MetaOverlays();
                $meta->setMetaKey('popup_text');
                $meta->setMetaValue("");

                
                // relates this product to the category
                $overlay->addMetaOverlay($meta);

                $entityManager = $doctrine->getManager();
                $entityManager->persist($meta);
                $entityManager->persist($overlay);
                $entityManager->flush();
            }
            if ($data->getWidgetIdAlpha() == "cam_heros" || $data->getWidgetIdBeta() == "cam_heros" || $data->getWidgetIdAlpha() == "cam_tournoi" || $data->getWidgetIdBeta() == "cam_tournoi") {
                for ($i=0; $i < 5; $i++) { 
                    // Insère les données suivantes dans la table meta_overlays si nécessaire
                    // DOCS: https://symfony.com/doc/current/doctrine/associations.html
                    $meta = new MetaOverlays();
                    $meta->setMetaKey('id_cam_obsninja_'.$i);
                    $meta->setMetaValue("");

                    
                    // relates this product to the category
                    $overlay->addMetaOverlay($meta);

                    $entityManager = $doctrine->getManager();
                    $entityManager->persist($meta);
                    $entityManager->persist($overlay);
                    $entityManager->flush();
                }
            }
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
