<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Widgets;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class WidgetsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
    $overlays = ['Alpha', 'Bravo', 'Charlie', 'Delta', 'Echo', 'Foxtrot', 'Golf', 'Hotel', 'India', 'Juliet', 'Kilo', 'Lima', 'Mike', 'November', 'Oscar', 'Papa', 'Quebec', 'Romeo', 'Sierra', 'Tango', 'Uniform', 'Victor', 'Whiskey', 'X-ray', 'Yankee', 'Zulu'];
    $widgets = ["Barre d'informations", "Versus", "Popup", "Next", "Tweets"];

    foreach ($overlays as $key1 => $value) {
     foreach ($widgets as $key2 => $value2) {
      $widget = new Widgets();
      $widget->setWidgetName($value2);
      $widget->setWidgetId($this->getReference('lib_widget_' . $key2));
      $widget->setOverlay($this->getReference('overlay_' . $key1));
      $widget->setWidgetVisible(false);
      if ($widget->getWidgetId()->getLibWidgetId2() != null) {
       $widget->setIsTwoWidgets(true);
      } else {
       $widget->setIsTwoWidgets(false);
      }

      $manager->persist($widget);
      $this->addReference('widget_' . $key1 . $key2, $widget);
     }
    $manager->flush();
    }
    }

    public function getDependencies()
    {
        return [
            LibWidgetsFixtures::class,
            OverlayFixtures::class,
        ];
    }
}