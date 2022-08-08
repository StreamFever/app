<?php

namespace App\Service;

use Symfony\Component\Security\Core\Security;
use App\Repository\OverlayRepository;
use Doctrine\ORM\Mapping as ORM;

class Overlays
{

 public function __construct(Security $security, OverlayRepository $overlayRepository)
 {
     // Avoid calling getUser() in the constructor: auth may not
     // be complete yet. Instead, store the entire Security object.
     $this->security = $security;
     $this->OverlayRepository = $overlayRepository;
 }

//  @ORM\Column(type="array", nullable=true)
 public function getOverlaysForSidebar(): Array
 {
   $currentUser = $this->security->getUser();

   return $this->OverlayRepository->findLastByIdUser($currentUser->getId());
 }
}