<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

use App\Repository\MetaRepository;

class MetaVoter extends Voter
{
    public const META_EDIT = 'META_EDIT';
    public const META_DELETE = 'META_DELETE';

    public function __construct(MetaRepository $metaRepository) {
        $this->metaRepository = $metaRepository;
    }

    protected function supports(string $attribute, $meta): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::META_EDIT, self::META_DELETE])
            && $meta instanceof \App\Entity\Meta;
    }

    protected function voteOnAttribute(string $attribute, $meta, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::META_EDIT:
                // logic to determine if the user can EDIT
                // return true or false

                // TODO: Pour $idOverlay, on doit récupérer l'id de l'overlay mais faut essayer de le faire via un service qu'on importe ici

                // La function du service sera appelé dans le controller et récupérera l'idOverlay
                // puis on fait passer l'id récupéré dans le constructeur
                if ($this->metaRepository->findAllByOverlay($meta->getWidgets()->getOverlay()->getId())) {
                    return true;
                }
                break;
            case self::META_DELETE:
                // logic to determine if the user can VIEW
                // return true or false
                if ($this->metaRepository->findAllByOverlay($meta->getWidgets()->getOverlay()->getId())) {
                    return true;
                }
                break;
        }

        return false;
    }
}
