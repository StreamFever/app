<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

use App\Repository\GameRepository;


class GameVoter extends Voter
{
    public const GAME_EDIT = 'GAME_EDIT';
    public const GAME_DELETE = 'GAME_DELETE';

    public function __construct(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    protected function supports(string $attribute, $game): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::GAME_EDIT, self::GAME_DELETE])
            && $game instanceof \App\Entity\Game;
    }

    protected function voteOnAttribute(string $attribute, $game, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        $user->getRoles() === ['ROLE_ADMIN'] ? true : false;

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::GAME_EDIT:
                // logic to determine if the user can EDIT
                // return true or false
                if ($game->getUserId() === $user->getId()) {
                    return true;
                } else if ($this->gameRepository->findAllCreatedByUserId($user->getId())) {
                    return true;
                }
                break;
            case self::GAME_DELETE:
                // logic to determine if the user can VIEW
                // return true or false
                if ($game->getUserId() === $user->getId()) {
                    return true;
                } else if ($this->gameRepository->findAllCreatedByUserId($user->getId())) {
                    return true;
                }
                break;
        }

        return false;
    }
}
