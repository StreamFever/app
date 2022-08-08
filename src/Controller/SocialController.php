<?php

namespace App\Controller;

use App\Entity\Social;
use App\Form\SocialType;
use App\Repository\SocialRepository;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/social")
 */
class SocialController extends AbstractController
{
    /**
     * @Route("/", name="app_social_index", methods={"GET"})
     */
    public function index(SocialRepository $socialRepository, EventRepository $eventRepository): Response
    {
        $currentUser = $this->getUser();

        return $this->render('social/index.html.twig', [
            'socials' => $socialRepository->findByIdUser($currentUser->getId()),
            'events' => $eventRepository->findByIdUser($currentUser->getId()),
        ]);
    }

    /**
     * @Route("/new", name="app_social_new", methods={"GET", "POST"})
     */
    public function new(Request $request, SocialRepository $socialRepository): Response
    {
        $social = new Social();
        $form = $this->createForm(SocialType::class, $social);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $socialRepository->add($social);
            return $this->redirectToRoute('app_social_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('social/new.html.twig', [
            'social' => $social,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_social_show", methods={"GET"})
     */
    public function show(Social $social): Response
    {
        return $this->render('social/show.html.twig', [
            'social' => $social,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_social_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Social $social, SocialRepository $socialRepository): Response
    {
        $form = $this->createForm(SocialType::class, $social);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $socialRepository->add($social);
            return $this->redirectToRoute('app_social_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('social/edit.html.twig', [
            'social' => $social,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_social_delete", methods={"POST"})
     */
    public function delete(Request $request, Social $social, SocialRepository $socialRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$social->getId(), $request->request->get('_token'))) {
            $socialRepository->remove($social);
        }

        return $this->redirectToRoute('app_social_index', [], Response::HTTP_SEE_OTHER);
    }
}
