<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\LibSocials;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LibSocialsFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
    $socials = ['facebook', 'twitter', 'instagram', 'youtube', 'linkedin', 'twitch', 'discord'];
    $socials_logo = ['akar-icons:facebook-fill', 'akar-icons:twitter-fill', 'akar-icons:instagram-fill', 'akar-icons:youtube-fill', 'akar-icons:linkedin-box-fill', 'akar-icons:twitch-fill', 'akar-icons:discord-fill'];

     foreach ($socials as $key => $value) {
      $libSocial = new LibSocials();
      $libSocial->setLibSocialName($value);
      $libSocial->setLibSocialLogo($socials_logo[$key]);
      $manager->persist($libSocial);

      $this->addReference('libsocial_' . $key, $libSocial);
     }
     $manager->flush();

    }
}