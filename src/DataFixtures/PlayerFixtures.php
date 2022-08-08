<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PlayerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $player = new Player();
            $player->setPlayerName('Joueur '.$i);
            $manager->persist($player);
            $this->addReference('player_'.$i, $player);
        }

        $manager->flush();
    }
}