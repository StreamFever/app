<?php

namespace App\Controller;

use App\Entity\Logs;
use App\Form\LogsType;
use App\Repository\LogsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/logs")
 */
class LogsController extends AbstractController
{
    /**
     * @Route("/", name="app_logs_index", methods={"GET"})
     */
    public function index(LogsRepository $logsRepository): Response
    {
        return $this->render('logs/index.html.twig', [
            'logs' => $logsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_logs_new", methods={"GET", "POST"})
     */
    public function new(Request $request, LogsRepository $logsRepository): Response
    {
        $log = new Logs();
        $form = $this->createForm(LogsType::class, $log);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $logsRepository->add($log);
            return $this->redirectToRoute('app_logs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('logs/new.html.twig', [
            'log' => $log,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_logs_show", methods={"GET"})
     */
    public function show(Logs $log): Response
    {
        return $this->render('logs/show.html.twig', [
            'log' => $log,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_logs_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Logs $log, LogsRepository $logsRepository): Response
    {
        $form = $this->createForm(LogsType::class, $log);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $logsRepository->add($log);
            return $this->redirectToRoute('app_logs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('logs/edit.html.twig', [
            'log' => $log,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_logs_delete", methods={"POST"})
     */
    public function delete(Request $request, Logs $log, LogsRepository $logsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$log->getId(), $request->request->get('_token'))) {
            $logsRepository->remove($log);
        }

        return $this->redirectToRoute('app_logs_index', [], Response::HTTP_SEE_OTHER);
    }
}
