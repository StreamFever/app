<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Game;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GameFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
    // $teams = ['Alpha', 'Beta', 'Gamma', 'Delta', 'Epsilon', 'Zeta', 'Eta', 'Theta', 'Iota', 'Kappa', 'Lambda', 'Mu', 'Nu', 'Xi', 'Omicron', 'Pi', 'Rho', 'Sigma', 'Tau', 'Upsilon', 'Phi', 'Chi', 'Psi', 'Omega'];

    // foreach ($teams as $key => $value) {
    //  $game = new Game();
    //  $game->setGameIdTeamAlpha($this->getReference('team_' . rand(0, 19)));
    //  $game->setGameIdTeamBeta($this->getReference('team_' . rand(0, 19)));
    //  $game->setGameName($game->getGameIdTeamAlpha()->getTeamName() . ' vs ' . $game->getGameIdTeamBeta()->getTeamName());
    //  $game->setGameStartDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
    //  $game->setGameFormat($this->getReference('format_' . rand(0, 4)));
    //  $game->setGameStatus($this->getReference('status_' . rand(0, 2)));
    //  $game->addGameIdMap($this->getReference('map_' . rand(0, 4)));
    //  $game->addGameIdMap($this->getReference('map_' . rand(0, 4)));
    //  $game->addGameIdMap($this->getReference('map_' . rand(0, 4)));
    //  $game->setUserId($this->getReference('user_1'));
    // //  $game->setOverlayId($this->getReference('overlay_' . rand(0, 24)));
      
    //   $manager->persist($game);
    //   $this->addReference('game_' . $key, $game);
    // }
    // $manager->flush();
    }

    public function getDependencies()
    {
        return [
            TeamFixtures::class,
            FormatFixtures::class,
            MapFixtures::class,
            OverlayFixtures::class,
            StatusFixtures::class,
        ];
    }
}