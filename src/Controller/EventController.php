<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

use App\Service\FileUploader;

/**
 * @Route("/admin/events")
 */
class EventController extends AbstractController
{
    /**
     * @Route("/", name="app_event_index", methods={"GET"})
     */
    public function index(EventRepository $eventRepository): Response
    {
        return $this->render('event/index.html.twig', [
            'events' => $eventRepository->findAll(),
            'controller_name' => 'EventController',
        ]);
    }

    /**
     * @Route("/new", name="app_event_new", methods={"GET", "POST"})
     */
    public function new(Request $request, FileUploader $fileUploader, EventRepository $eventRepository, ManagerRegistry $doctrine): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            /** @var UploadedFile $logoFile */
            $logoFile = $form->get('eventLogo')->getData();
            if ($logoFile) {
                $logoFileName = $fileUploader->uploadLogo($logoFile);
                $data->setEventLogo($logoFileName);
            }

            if ($data->getEventEdition() == "campus_cup" && $data->getEventLogo() == null) {
                $data->setEventLogo("https://cdn.artaic.fr/images/CampusCupLogo.png");
                $entityManager = $doctrine->getManager();
                $entityManager->persist($event);
                $entityManager->flush();
            } else {
            $eventRepository->add($event);
            }

            $this->addFlash('success', 'L\'événement a bien été crée !');
            return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event/new.html.twig', [
            'event' => $event,
            'form' => $form,
            'controller_name' => 'EventController',
        ]);
    }

    /**
     * @Route("/{id}", name="app_event_show", methods={"GET"})
     */
    public function show(Event $event): Response
    {
        return $this->render('event/show.html.twig', [
            'event' => $event,
            'controller_name' => 'EventController',
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_event_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, FileUploader $fileUploader, Event $event, EventRepository $eventRepository): Response
    {
        $this->denyAccessUnlessGranted('EVENT_EDIT', $event);
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            /** @var UploadedFile $logoFile */
            $logoFile = $form->get('eventLogo')->getData();
            if ($logoFile) {
                $logoFileName = $fileUploader->uploadLogo($logoFile);
                $data->setEventLogo($logoFileName);
            }

            $eventRepository->add($event);

            $this->addFlash('success', 'L\'événement a bien été modifié !');

            if ($request->query->get('id_overlay')) {
                return $this->redirectToRoute('app_overlay_show', [
                    'id' => $request->query->get('id_overlay'),
                ], Response::HTTP_SEE_OTHER);
            } else {
                return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->renderForm('event/edit.html.twig', [
            'event' => $event,
            'form' => $form,
            'controller_name' => 'EventController',
        ]);
    }

    /**
     * @Route("/{id}", name="app_event_delete", methods={"POST"})
     */
    public function delete(Request $request, Event $event, EventRepository $eventRepository): Response
    {
        $this->denyAccessUnlessGranted('EVENT_DELETE', $event);
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $eventRepository->remove($event);
        }

        return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
    }
}
