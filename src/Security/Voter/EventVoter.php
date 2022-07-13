<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

use App\Repository\EventRepository;


class EventVoter extends Voter
{
    public const EVENT_EDIT = 'EVENT_EDIT';
    public const EVENT_DELETE = 'EVENT_DELETE';

    public function __construct(EventRepository $eventRepository) {
        $this->eventRepository = $eventRepository;
    }


    protected function supports(string $attribute, $event): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::EVENT_EDIT, self::EVENT_DELETE])
            && $event instanceof \App\Entity\Event;
    }

    protected function voteOnAttribute(string $attribute, $event, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        $user->getRoles() === ['ROLE_ADMIN'] ? true : false;

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::EVENT_EDIT:
                // logic to determine if the user can EDIT
                // return true or false
                if ($event->getUserId() === $user->getId()) {
                    return true;
                }
                if ($this->eventRepository->findFirst()) {
                    return true;
                }
                break;
            case self::EVENT_DELETE:
                // logic to determine if the user can VIEW
                // return true or false
                if ($event->getUserId() === $user->getId()) {
                    return true;
                }
                if ($this->eventRepository->findFirst()) {
                    return true;
                }
                break;
        }

        return false;
    }
}
