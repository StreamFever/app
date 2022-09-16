<?php

namespace App\Service;

use Symfony\Component\Security\Core\Security;
use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;

class Events
{

    public function __construct(Security $security, EventRepository $eventRepository)
    {
        // Avoid calling getUser() in the constructor: auth may not
        // be complete yet. Instead, store the entire Security object.
        $this->security = $security;
        $this->EventRepository = $eventRepository;
    }

    public function getAllEvents(): array
    {
        return $this->EventRepository->findAll();
    }

    public function getOneCurrentEvent(): array
    {
        return $this->EventRepository->findFirst();
    }

    public function getRecentsEvent(): array
    {
        return $this->EventRepository->findRecentsEvent();
    }
}
