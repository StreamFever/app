<?php

namespace App\Service;

use Symfony\Component\Security\Core\Security;
use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

class SponsorsService
{

 public function __construct(Security $security, GameRepository $gameRepository)
 {
     // Avoid calling getUser() in the constructor: auth may not
     // be complete yet. Instead, store the entire Security object.
     $this->security = $security;
     $this->GameRepository = $gameRepository;
 }

 public function getSponsorsOfIdEvent($idEvent): Array
 {
   $currentUser = $this->security->getUser();
   return $this->GameRepository->findFirst();
 }

 public function getOneNextMatch(): Array
 {
   $currentUser = $this->security->getUser();
   return $this->GameRepository->findFirst();
 }
}