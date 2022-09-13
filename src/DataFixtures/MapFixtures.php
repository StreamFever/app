<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\LibMaps;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MapFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $maps = ['Bank', 'Bartlett', 'Border', 'Chalet', 'Club House', 'Coastline', 'Consulate', 'Kafe', 'Emerald P.', 'Favela', 'Fortress', 'Hereford', 'House', 'Kanal', 'Oregon', 'Outback', 'Plane', 'Skyscraper', 'Theme Park', 'Tower', 'Villa', 'Yatch'];
        $maps_id = ['bank', 'bartlett', 'border', 'chalet', 'club_house', 'coastline', 'consulat', 'kafe', 'emerald', 'favela', 'fortress', 'hereford', 'house', 'kanal', 'oregon', 'outback', 'plane', 'skyscraper', 'theme_park', 'tower', 'villa', 'yatch'];

        foreach ($maps as $key => $value) {
            $map = new LibMaps();
            $map->setMapName($value);
            $map->setMapImg('https://cdn.artaic.fr/stream_cave/img/maps/' . $maps_id[$key] . '.jpg');

            $manager->persist($map);
            $this->addReference('map_' . $key, $map);
        }
        $manager->flush();
    }
}
