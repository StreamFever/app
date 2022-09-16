<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Format;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FormatFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

     $formats = ['BO1', 'BO2', 'BO3', 'BO4', 'BO5'];

     foreach ($formats as $key => $value) {
      $format = new Format();
      $format->setFormatName($value);
      $manager->persist($format);

      $this->addReference('format_' . $key, $format);
     }
     $manager->flush();
    }
}