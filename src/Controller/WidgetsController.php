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
     * @Route("/", name="app_widgets_index", methods={"GET"})
     */
    public function index(WidgetsRepository $widgetsRepository): Response
    {
        return $this->render('overlay/widgets/index.html.twig', [
            'widgets' => $widgetsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_widgets_new", methods={"GET", "POST"})
     */
    public function new(Request $request, WidgetsRepository $widgetsRepository, ManagerRegistry $doctrine): Response
    {
        $widget = new Widgets();
        $form = $this->createForm(WidgetsType::class, $widget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $widgetsRepository->add($widget);
            $data = $form->getData();

            if ($data->getWidgetId() == "topbar") {
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
            if ($data->getWidgetId() == "bottombar") {
                // Insère les données suivantes dans la table meta_overlays si nécessaire
                // DOCS: https://symfony.com/doc/current/doctrine/associations.html
                $meta = new Meta();
                $meta->setMetaKey('bottombar_marquee');
                $meta->setMetaValue("");
                $meta->setUserId($this->getUser());
                
                // relates this product to the category
                $widget->addMeta($meta);

                $entityManager = $doctrine->getManager();
                $entityManager->persist($meta);
                $entityManager->persist($widget);
                $entityManager->flush();
            }
            if ($data->getWidgetId() == "popup_text") {
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
            if ($data->getWidgetId() == "cam_heros") {
                for ($i=0; $i < 5; $i++) { 
                    // Insère les données suivantes dans la table meta_overlays si nécessaire
                    // DOCS: https://symfony.com/doc/current/doctrine/associations.html
                    $meta = new Meta();
                    $meta->setMetaKey('id_cam_heros_obsninja_'.$i);
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
            if ($data->getWidgetId() == "cam_tournament_alpha" || $data->getWidgetId() == "cam_tournament_beta") {
                for ($i=0; $i < 10; $i++) { 
                    // Insère les données suivantes dans la table meta_overlays si nécessaire
                    // DOCS: https://symfony.com/doc/current/doctrine/associations.html
                    $meta = new Meta();
                    $meta->setMetaKey('id_cam_team_obsninja_'.$i);
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
            if ($data->getWidgetId() == "tweets") {
                // Insère les données suivantes dans la table meta_overlays si nécessaire
                // DOCS: https://symfony.com/doc/current/doctrine/associations.html
                $meta = new Meta();
                $meta->setMetaKey('curent_tweet_format');
                $meta->setMetaValue("");
                $meta->setUserId($this->getUser());
                
                // relates this product to the category
                $widget->addMeta($meta);

                $entityManager = $doctrine->getManager();
                $entityManager->persist($meta);
                $entityManager->persist($widget);
                $entityManager->flush();
            }
            
            return $this->redirectToRoute('app_widgets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('overlay/widgets/new.html.twig', [
            'widget' => $widget,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_widgets_show", methods={"GET"})
     */
    public function show(Widgets $widget): Response
    {
        return $this->render('overlay/widgets/show.html.twig', [
            'widget' => $widget,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_widgets_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Widgets $widget, WidgetsRepository $widgetsRepository, ManagerRegistry $doctrine): Response
    {
        $form = $this->createForm(WidgetsType::class, $widget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $widgetsRepository->add($widget);
            $data = $form->getData();

            if ($data->getWidgetId() == "topbar") {
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
            if ($data->getWidgetId() == "bottombar") {
                // Insère les données suivantes dans la table meta_overlays si nécessaire
                // DOCS: https://symfony.com/doc/current/doctrine/associations.html
                $meta = new Meta();
                $meta->setMetaKey('bottombar_marquee');
                $meta->setMetaValue("");
                $meta->setUserId($this->getUser());
                
                // relates this product to the category
                $widget->addMeta($meta);

                $entityManager = $doctrine->getManager();
                $entityManager->persist($meta);
                $entityManager->persist($widget);
                $entityManager->flush();
            }
            if ($data->getWidgetId() == "popup_text") {
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
            if ($data->getWidgetId() == "cam_heros") {
                for ($i=0; $i < 5; $i++) { 
                    // Insère les données suivantes dans la table meta_overlays si nécessaire
                    // DOCS: https://symfony.com/doc/current/doctrine/associations.html
                    $meta = new Meta();
                    $meta->setMetaKey('id_cam_heros_obsninja_'.$i);
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
            if ($data->getWidgetId() == "cam_tournament_alpha" || $data->getWidgetId() == "cam_tournament_beta") {
                for ($i=0; $i < 10; $i++) { 
                    // Insère les données suivantes dans la table meta_overlays si nécessaire
                    // DOCS: https://symfony.com/doc/current/doctrine/associations.html
                    $meta = new Meta();
                    $meta->setMetaKey('id_cam_team_obsninja_'.$i);
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
            if ($data->getWidgetId() == "tweets") {
                // Insère les données suivantes dans la table meta_overlays si nécessaire
                // DOCS: https://symfony.com/doc/current/doctrine/associations.html
                $meta = new Meta();
                $meta->setMetaKey('curent_tweet_format');
                $meta->setMetaValue("");
                $meta->setUserId($this->getUser());
                
                // relates this product to the category
                $widget->addMeta($meta);

                $entityManager = $doctrine->getManager();
                $entityManager->persist($meta);
                $entityManager->persist($widget);
                $entityManager->flush();
            }
        
            
            return $this->redirectToRoute('app_widgets_index', [], Response::HTTP_SEE_OTHER);
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
        if ($this->isCsrfTokenValid('delete'.$widget->getId(), $request->request->get('_token'))) {
            $widgetsRepository->remove($widget);
        }

        return $this->redirectToRoute('app_widgets_index', [], Response::HTTP_SEE_OTHER);
    }
}
