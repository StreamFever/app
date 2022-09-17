<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/games")
 */
class GameController extends AbstractController
{
    /**
     * @Route("/", name="app_game_index", methods={"GET"})
     */
    public function index(GameRepository $gameRepository): Response
    {


        return $this->render('game/index.html.twig', [
            'games' => $gameRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_game_new", methods={"GET", "POST"})
     */
    public function new(Request $request, GameRepository $gameRepository): Response
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($game->getCurrentMap() == null && $game->getGameIdMaps()->count() > 0) {
                $game->setCurrentMap($game->getGameIdMaps()[0]);
            }
            $game->setGameName($game->getGameIdTeamAlpha()->getTeamName() . ' VS ' . $game->getGameIdTeamBeta()->getTeamName());
            $game->setUserId($this->getUser());
            $gameRepository->add($game);

            $this->addFlash('success', 'Le match a bien été créée !');

            return $this->redirectToRoute('app_game_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('game/new.html.twig', [
            'game' => $game,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_game_show", methods={"GET"})
     */
    public function show(Game $game): Response
    {
        return $this->render('game/show.html.twig', [
            'game' => $game,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_game_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Game $game, GameRepository $gameRepository): Response
    {
        $this->denyAccessUnlessGranted('GAME_EDIT', $game);
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($game->getCurrentMap() == null && $game->getGameIdMaps()->count() > 0) {
                $game->setCurrentMap($game->getGameIdMaps()[0]);
            }
            $game->setGameName($game->getGameIdTeamAlpha()->getTeamName() . ' VS ' . $game->getGameIdTeamBeta()->getTeamName());
            $game->setUserId($this->getUser());
            $gameRepository->add($game);

            $this->addFlash('success', 'Le match a bien été modifié !');

            if ($request->query->get('id_overlay')) {
                return $this->redirectToRoute('app_overlay_show', [
                    'id' => $request->query->get('id_overlay'),
                ], Response::HTTP_SEE_OTHER);
            } else {
                return $this->redirectToRoute('app_game_index', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->renderForm('game/edit.html.twig', [
            'game' => $game,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_game_delete", methods={"POST"})
     */
    public function delete(Request $request, Game $game, GameRepository $gameRepository): Response
    {
        $this->denyAccessUnlessGranted('GAME_DELETE', $game);
        if ($this->isCsrfTokenValid('delete' . $game->getId(), $request->request->get('_token'))) {
            $gameRepository->remove($game);
        }

        return $this->redirectToRoute('app_game_index', [], Response::HTTP_SEE_OTHER);
    }
}
