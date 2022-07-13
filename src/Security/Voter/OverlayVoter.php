<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class OverlayVoter extends Voter
{
    public const OVERLAY_EDIT = 'OVERLAY_EDIT';
    public const OVERLAY_VIEW = 'OVERLAY_VIEW';
    public const OVERLAY_DELETE = 'OVERLAY_DELETE';

    protected function supports(string $attribute, $overlay): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::OVERLAY_EDIT, self::OVERLAY_VIEW, self::OVERLAY_DELETE])
            && $overlay instanceof \App\Entity\Overlay;
    }

    protected function voteOnAttribute(string $attribute, $overlay, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        $user->getRoles() === ['ROLE_ADMIN'] ? true : false;


        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::OVERLAY_EDIT:
                // logic to determine if the user can EDIT
                // return true or false
                if ($overlay->getOverlayOwner() === $user) {
                    return true;
                }
        
                for ($i=0; $i < count($overlay->getOverlayAccess()) ; $i++) { 
                    if ($overlay->getOverlayAccess()[$i] === $user) {
                        return true;
                    }
                }
                break;
            case self::OVERLAY_VIEW:
                // logic to determine if the user can VIEW
                // return true or false
                if ($overlay->getOverlayOwner() === $user) {
                    return true;
                }
        
                for ($i=0; $i < count($overlay->getOverlayAccess()) ; $i++) { 
                    if ($overlay->getOverlayAccess()[$i] === $user) {
                        return true;
                    }
                }
                break;
            case self::OVERLAY_DELETE:
                // logic to determine if the user can VIEW
                // return true or false
                return $overlay->getOverlayOwner() === $user;
                break;
        }

        return false;
    }
}
