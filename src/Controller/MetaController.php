<?php

namespace App\Controller;

use App\Entity\Meta;
use App\Form\MetaType;
use App\Repository\MetaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/overlay/meta")
 */
class MetaController extends AbstractController
{
    /**
     * @Route("/", name="app_meta_index", methods={"GET"})
     */
    public function index(MetaRepository $metaRepository): Response
    {
        return $this->render('overlay/meta/index.html.twig', [
            'metas' => $metaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_meta_new", methods={"GET", "POST"})
     */
    public function new(Request $request, MetaRepository $metaRepository): Response
    {
        $metum = new Meta();
        $form = $this->createForm(MetaType::class, $metum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $metaRepository->add($metum);
            return $this->redirectToRoute('app_meta_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('overlay/meta/new.html.twig', [
            'metum' => $metum,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_meta_show", methods={"GET"})
     */
    public function show(Meta $metum): Response
    {
        return $this->render('overlay/meta/show.html.twig', [
            'metum' => $metum,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_meta_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Meta $metum, MetaRepository $metaRepository): Response
    {
        $form = $this->createForm(MetaType::class, $metum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $metaRepository->add($metum);
            return $this->redirectToRoute('app_meta_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('overlay/meta/edit.html.twig', [
            'metum' => $metum,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_meta_delete", methods={"POST"})
     */
    public function delete(Request $request, Meta $metum, MetaRepository $metaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$metum->getId(), $request->request->get('_token'))) {
            $metaRepository->remove($metum);
        }

        return $this->redirectToRoute('app_meta_index', [], Response::HTTP_SEE_OTHER);
    }
}
