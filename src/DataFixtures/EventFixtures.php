<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EventFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // $editions = ['her6s', 'campus_cup', 'salty_duels', 'hors_serie'];

        // foreach ($editions as $key => $value) {

        //     $event = new Event();
        //     if ($value == 'her6s') {
        //         $event->setEventName("Her6s d'oregon");
        //         $event->setEventHashtag("#HER6S");
        //         $event->setEventLogo('https://cdn.artaic.fr/stream_cave/img/event/salty_academy.png');
        //         $event->setEventSlots(0);
        //         $event->setEventCashprize(0 . '$');
        //     } else if ($value == 'campus_cup') {
        //         $event->setEventName("Campus cup");
        //         $event->setEventHashtag("#CampusCup");
        //         $event->setEventLogo('https://cdn.artaic.fr/stream_cave/img/event/campus_cup.png');
        //         $event->setEventSlots(64);
        //         $event->setEventCashprize(1000 . '$');
        //     } else if ($value == 'salty_duels') {
        //         $event->setEventName("Salty duels");
        //         $event->setEventHashtag("#SaltyDuels");
        //         $event->setEventLogo('https://cdn.artaic.fr/stream_cave/img/event/salty_duels.png');
        //         $event->setEventSlots(64);
        //         $event->setEventCashprize(1000 . '$');
        //     } else if ($value == 'hors_serie') {
        //         $event->setEventName("Hors série");
        //         $event->setEventHashtag("#HorsSerie");
        //         $event->setEventLogo('https://cdn.artaic.fr/stream_cave/img/logo_streamcave.svg');
        //         $event->setEventSlots(64);
        //         $event->setEventCashprize(100 . '$');
        //     }
        //     $event->setEventEdition($this->getReference('edition_' . $key));
        //     $event->setEventStartDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
        //     $event->setEventEndDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
        //     $event->setEventFormat($this->getReference('eventformat_' . rand(1, 5)));
        //     // $event->setOverlayId($this->getReference('overlay_' . rand(1, 24)));
        //     $event->addEventAccess($this->getReference('user_' . rand(1, 2)));
        //     $event->addSocial($this->getReference('social_' . rand(1, 2)));
        //     // $event->addEventIdSponsor($this->getReference('sponsor_1'));
        //     $event->setUserId($this->getReference('user_1'));


        //     $manager->persist($event);
        //     $manager->flush();
        // }
    }

    public function getDependencies()
    {
        return [
            EditionFixtures::class,
            FormatFixtures::class,
            OverlayFixtures::class,
            SocialFixtures::class,
            SponsorFixtures::class,
            AppFixtures::class,
        ];
    }
}
