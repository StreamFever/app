<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\EventFormat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EventFormatFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

     $event_formats = ['1v1', '2v2', '3v3', '4v4', '5v5', '6v6'];

     foreach ($event_formats as $key => $value) {
      $event_format = new EventFormat();
      $event_format->setEventFormatName($value);
      $manager->persist($event_format);

      $this->addReference('eventformat_' . $key, $event_format);
     }
     $manager->flush();
    }
}