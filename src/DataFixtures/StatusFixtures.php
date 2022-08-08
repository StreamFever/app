<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatusFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

     $status = ['current', 'finished', 'soon'];

     foreach ($status as $key => $value) {
      $status_e = new Status();
      $status_e->setStatusName($value);
      $manager->persist($status_e);

      $this->addReference('status_' . $key, $status_e);
     }
     $manager->flush();
    }
}