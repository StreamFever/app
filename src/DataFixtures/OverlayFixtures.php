<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Overlay;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OverlayFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    $overlays = ['Alpha', 'Bravo', 'Charlie', 'Delta', 'Echo', 'Foxtrot', 'Golf', 'Hotel', 'India', 'Juliet', 'Kilo', 'Lima', 'Mike', 'November', 'Oscar', 'Papa', 'Quebec', 'Romeo', 'Sierra', 'Tango', 'Uniform', 'Victor', 'Whiskey', 'X-ray', 'Yankee', 'Zulu'];

    foreach ($overlays as $key => $value) {
      $user = $this->getReference('user_1');
      
      $overlay = new Overlay();
      $overlay->setOverlayName($value);
      $overlay->setOverlayOwner($user);
      $overlay->addOverlayAccess($this->getReference('user_2'));
      
      $manager->persist($overlay);
      $this->addReference('overlay_' . $key, $overlay);
    }
    $manager->flush();
    }
}