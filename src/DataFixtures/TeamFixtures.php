<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TeamFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
    $teams = ['Alpha', 'Beta', 'Gamma', 'Delta', 'Epsilon', 'Zeta', 'Eta', 'Theta', 'Iota', 'Kappa', 'Lambda', 'Mu', 'Nu', 'Xi', 'Omicron', 'Pi', 'Rho', 'Sigma', 'Tau', 'Upsilon', 'Phi', 'Chi', 'Psi', 'Omega'];

    foreach ($teams as $key => $value) {
     $team = new Team();
     $team->setTeamName($value);
     $team->addPlayer($this->getReference('player_' . rand(0, 19)));

     $manager->persist($team);     
     $this->addReference('team_' . $key, $team);
    }
    $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PlayerFixtures::class,
        ];
    }
}