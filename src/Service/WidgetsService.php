<?php

namespace App\Service;

use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\Mapping as ORM;

class WidgetsService
{

 public function __construct(Security $security)
 {
     // Avoid calling getUser() in the constructor: auth may not
     // be complete yet. Instead, store the entire Security object.
     $this->security = $security;
 }

 public function getJsonData($request)
{
    $json = file_get_contents($request);
    return json_decode($json, true);
}
}