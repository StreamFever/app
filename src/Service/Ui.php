<?php

namespace App\Service;

use Symfony\Component\Security\Core\Security;
use App\Repository\UiRepository;
use Doctrine\ORM\Mapping as ORM;

class Ui
{

 public function __construct(Security $security, UiRepository $uiRepository)
 {
     // Avoid calling getUser() in the constructor: auth may not
     // be complete yet. Instead, store the entire Security object.
     $this->security = $security;
     $this->UiRepository = $uiRepository;
 }

//  @ORM\Column(type="array", nullable=true)
 public function getUiData(): Array
 {
   $currentUser = $this->security->getUser();

   return $this->UiRepository->findAllByIdUser($currentUser->getId());
 }
}