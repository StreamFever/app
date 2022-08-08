<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Meta;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MetaFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
    $overlays = ['Alpha', 'Bravo', 'Charlie', 'Delta', 'Echo', 'Foxtrot', 'Golf', 'Hotel', 'India', 'Juliet', 'Kilo', 'Lima', 'Mike', 'November', 'Oscar', 'Papa', 'Quebec', 'Romeo', 'Sierra', 'Tango', 'Uniform', 'Victor', 'Whiskey', 'X-ray', 'Yankee', 'Zulu'];
    $metas = ["popup_text", "topbar_title", "bottombar_marquee", "tweet_hashtag", "tweet_id"];

    foreach ($overlays as $key1 => $value) {
     foreach ($metas as $key2 => $value2) {
      $meta = new Meta();
      $meta->setMetaKey($value2);
      if ($meta->getMetaKey() == "popup_text") {
       $meta->setMetaValue("This is a popup text");
      } else if ($meta->getMetaKey() == "topbar_title") {
       $meta->setMetaValue("topbar title");
      } else if ($meta->getMetaKey() == "bottombar_marquee") {
       $meta->setMetaValue("lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua");
      } else if ($meta->getMetaKey() == "tweet_hashtag") {
       $meta->setMetaValue("hashtagtest". rand(1, 100));
      } else if ($meta->getMetaKey() == "tweet_id") {
       $meta->setMetaValue(rand(1, 100));
      }
      $meta->setUserId($this->getReference('user_1'));
      $meta->setWidgets($this->getReference('widget_' . $key1 . rand(0, 4)));

      $manager->persist($meta);
      $this->addReference('meta_' . $key1 . $key2, $meta);
      }
     }
     $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AppFixtures::class,
            WidgetsFixtures::class,
        ];
    }
}