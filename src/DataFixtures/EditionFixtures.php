<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Edition;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EditionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

     $editions = ['her6s', 'campus_cup', 'salty_duels', 'yunktis_royale', 'hors_serie'];

     foreach ($editions as $key => $value) {
      $edition = new Edition();
      $edition->setEditionName($value);
      $manager->persist($edition);

      $this->addReference('edition_' . $key, $edition);
     }
     $manager->flush();
    }
}