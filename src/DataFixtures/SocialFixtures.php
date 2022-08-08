<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Social;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SocialFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
    $socials = ['facebook', 'twitter', 'instagram', 'youtube', 'linkedin', 'twitch', 'discord'];

    foreach ($socials as $key => $value) {
     $libSocialId = $this->getReference('libsocial_' . $key);
     $user = $this->getReference('user_1');
      
      $social = new Social();
      $social->setSocialLib($libSocialId);
      $social->setUserId($user);
      $social->setSocialTag('Test_' . $key);
      
      $manager->persist($social);
      $this->addReference('social_' . $key, $social);
    }
    $manager->flush();
    }

    public function getDependencies()
    {
        return [
            LibSocialsFixtures::class,
        ];
    }
}