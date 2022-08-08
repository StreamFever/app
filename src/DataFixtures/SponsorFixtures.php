<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Sponsor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SponsorFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

     $sponsors = ['Firstblood', 'VastGG', 'maaKu'];

     foreach ($sponsors as $key => $value) {
      $sponsor = new Sponsor();
      $sponsor->setSponsorName($value);
      $manager->persist($sponsor);

      $this->addReference('sponsor_' . $key, $sponsor);
     }
     $manager->flush();
    }
}