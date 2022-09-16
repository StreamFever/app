<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

use App\Repository\WidgetsRepository;

class WidgetsVoter extends Voter
{
    public const WIDGET_EDIT = 'WIDGET_EDIT';
    public const WIDGET_DELETE = 'WIDGET_DELETE';

    public function __construct(WidgetsRepository $widgetsRepository) {
        $this->widgetsRepository = $widgetsRepository;
    }

    protected function supports(string $attribute, $widgets): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::WIDGET_EDIT, self::WIDGET_DELETE])
            && $widgets instanceof \App\Entity\Widgets;
    }

    protected function voteOnAttribute(string $attribute, $widgets, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::WIDGET_EDIT:
                // logic to determine if the user can EDIT
                // return true or false
                if ($this->widgetsRepository->findAllByOverlay($widgets->getOverlay()->getId())) {
                    return true;
                }
                break;
            case self::WIDGET_DELETE:
                // logic to determine if the user can VIEW
                // return true or false
                if ($this->widgetsRepository->findAllByOverlay($widgets->getOverlay()->getId())) {
                    return true;
                }
                break;
        }

        return false;
    }
}
