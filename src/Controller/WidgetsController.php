<?php

namespace App\Controller;

use App\Entity\Widgets;
use App\Entity\Meta;
use App\Form\WidgetsType;
use App\Repository\WidgetsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @Route("/admin/widget")
 */
class WidgetsController extends AbstractController
{
    /**
     * @Route("/new", name="app_widgets_new", methods={"GET", "POST"})
     */
    public function new(Request $request, WidgetsRepository $widgetsRepository, ManagerRegistry $doctrine): Response
    {
        $widget = new Widgets();
        $form = $this->createForm(WidgetsType::class, $widget);
        $form->handleRequest($request);
        $idOverlay = $request->get('id_overlay');

        if ($form->isSubmitted() && $form->isValid()) {
            if ($widget->getIsTwoWidgets() == null) {
                $widget->setIsTwoWidgets(false);
            }
            $widgetsRepository->add($widget);
            $data = $form->getData();

            if ($data->getWidgetId() == "Barre d'informations") {
                // Insère les données suivantes dans la table meta_overlays si nécessaire
                // DOCS: https://symfony.com/doc/current/doctrine/associations.html
                $meta = new Meta();
                $meta->setMetaKey('topbar_title');
                $meta->setMetaValue("");
                $meta->setUserId($this->getUser());


                // relates this product to the category
                $widget->addMeta($meta);

                $entityManager = $doctrine->getManager();
                $entityManager->persist($meta);
                $entityManager->persist($widget);
                $entityManager->flush();
            }
            if ($data->getWidgetId() == "Barre d'informations") {
                // Insère les données suivantes dans la table meta_overlays si nécessaire
                // DOCS: https://symfony.com/doc/current/doctrine/associations.html
                for ($i = 1; $i < 5; $i++) {
                    $meta = new Meta();
                    $meta->setMetaKey('bottombar_marquee_' . $i);
                    $meta->setMetaValue("");
                    $meta->setUserId($this->getUser());

                    // relates this product to the category
                    $widget->addMeta($meta);

                    $entityManager = $doctrine->getManager();
                    $entityManager->persist($meta);
                    $entityManager->persist($widget);
                    $entityManager->flush();
                }
            }
            if ($data->getWidgetId() == "Popup") {
                // Insère les données suivantes dans la table meta_overlays si nécessaire
                // DOCS: https://symfony.com/doc/current/doctrine/associations.html
                $meta = new Meta();
                $meta->setMetaKey('popup_text');
                $meta->setMetaValue("");
                $meta->setUserId($this->getUser());

                // relates this product to the category
                $widget->addMeta($meta);

                $entityManager = $doctrine->getManager();
                $entityManager->persist($meta);
                $entityManager->persist($widget);
                $entityManager->flush();
            }
            if ($data->getWidgetId() == "Tweets") {
                // Insère les données suivantes dans la table meta_overlays si nécessaire
                // DOCS: https://symfony.com/doc/current/doctrine/associations.html
                $arrTweets = ['tweet_id', 'tweet_hashtag'];
                foreach ($arrTweets as $key => $value) {
                    $meta = new Meta();
                    $meta->setMetaKey($value);
                    $meta->setMetaValue("");
                    $meta->setUserId($this->getUser());

                    $widget->addMeta($meta);

                    $entityManager = $doctrine->getManager();
                    $entityManager->persist($meta);
                    $entityManager->persist($widget);
                    $entityManager->flush();
                }
            }

            if ($idOverlay) {
                return $this->redirectToRoute('app_overlay_show', [
                    'id' => $idOverlay
                ], Response::HTTP_SEE_OTHER);
            } else {
                return $this->redirectToRoute('app_overlay_index', [], Response::HTTP_SEE_OTHER);
            }

            $this->addFlash('success', 'Le widget a bien été crée !');
        }

        return $this->renderForm('overlay/widgets/new.html.twig', [
            'widget' => $widget,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_widgets_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Widgets $widget, WidgetsRepository $widgetsRepository, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('WIDGET_EDIT', $widget);

        $form = $this->createForm(WidgetsType::class, $widget);
        $form->handleRequest($request);
        $idOverlay = $request->get('id_overlay');


        if ($form->isSubmitted() && $form->isValid()) {
            if ($widget->getIsTwoWidgets() == null) {
                $widget->setIsTwoWidgets(false);
            }
            $widgetsRepository->add($widget);
            $data = $form->getData();

            if ($data->getWidgetId() == "Barre d'informations") {
                // Insère les données suivantes dans la table meta_overlays si nécessaire
                // DOCS: https://symfony.com/doc/current/doctrine/associations.html
                if (!$data->getMetas()->get('topbar_title')) {
                    $meta = new Meta();
                    $meta->setMetaKey('topbar_title');
                    $meta->setMetaValue("");
                    $meta->setUserId($this->getUser());

                    // relates this product to the category
                    $widget->addMeta($meta);

                    $entityManager = $doctrine->getManager();
                    $entityManager->persist($meta);
                    $entityManager->persist($widget);
                    $entityManager->flush();
                }
            }
            if ($data->getWidgetId() == "Barre d'informations") {
                // Insère les données suivantes dans la table meta_overlays si nécessaire
                // DOCS: https://symfony.com/doc/current/doctrine/associations.html

                if (!$data->getMetas()->get('bottom_marquee')) {
                    for ($i = 1; $i < 5; $i++) {
                        $meta = new Meta();
                        $meta->setMetaKey('bottombar_marquee_' . $i);
                        $meta->setMetaValue("");
                        $meta->setUserId($this->getUser());
    
                        // relates this product to the category
                        $widget->addMeta($meta);
    
                        $entityManager = $doctrine->getManager();
                        $entityManager->persist($meta);
                        $entityManager->persist($widget);
                        $entityManager->flush();
                    }
                }
            }
            if ($data->getWidgetId() == "Popup") {
                // Insère les données suivantes dans la table meta_overlays si nécessaire
                // DOCS: https://symfony.com/doc/current/doctrine/associations.html

                if (!$data->getMetas()->get('popup_text')) {
                    $meta = new Meta();
                    $meta->setMetaKey('popup_text');
                    $meta->setMetaValue("");
                    $meta->setUserId($this->getUser());

                    // relates this product to the category
                    $widget->addMeta($meta);

                    $entityManager = $doctrine->getManager();
                    $entityManager->persist($meta);
                    $entityManager->persist($widget);
                    $entityManager->flush();
                }
            }
            if ($data->getWidgetId() == "Tweets") {
                // Insère les données suivantes dans la table meta_overlays si nécessaire
                // DOCS: https://symfony.com/doc/current/doctrine/associations.html
                if (!$data->getMetas()->get('tweet_id')) {
                    $meta = new Meta();
                    $meta->setMetaKey('tweet_id');
                    $meta->setMetaValue("");
                    $meta->setUserId($this->getUser());

                    $meta2 = new Meta();
                    $meta2->setMetaKey('tweet_hashtag');
                    $meta2->setMetaValue("");
                    $meta2->setUserId($this->getUser());

                    // relates this product to the category
                    $widget->addMeta($meta);
                    $widget->addMeta($meta2);

                    $entityManager = $doctrine->getManager();
                    $entityManager->persist($meta);
                    $entityManager->persist($widget);
                    $entityManager->flush();
                }
            }


            if ($idOverlay) {
                return $this->redirectToRoute('app_overlay_show', [
                    'id' => $idOverlay
                ], Response::HTTP_SEE_OTHER);
            } else {
                return $this->redirectToRoute('app_overlay_index', [], Response::HTTP_SEE_OTHER);
            }

            $this->addFlash('success', 'Le widget a bien été modifié !');
        }

        return $this->renderForm('overlay/widgets/edit.html.twig', [
            'widget' => $widget,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_widgets_delete", methods={"POST"})
     */
    public function delete(Request $request, Widgets $widget, WidgetsRepository $widgetsRepository): Response
    {
        $this->denyAccessUnlessGranted('WIDGET_DELETE', $widget);

        if ($this->isCsrfTokenValid('delete' . $widget->getId(), $request->request->get('_token'))) {
            $widgetsRepository->remove($widget);
        }

        return $this->redirectToRoute('app_overlay_index', [], Response::HTTP_SEE_OTHER);
    }
}
