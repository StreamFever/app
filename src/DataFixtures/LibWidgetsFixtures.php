<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\LibWidgets;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LibWidgetsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $widgets = ["Barre d'informations", "Versus", "Popup", "Next", "Tweets", "Cameras Team"];
        $widgetId = ["topbar", "versus", "popup_text", "next", "tweets", "cameras_alpha"];
        $widgetId2 = ["bottombar", null, null, null, null, 'cameras_beta'];

        foreach ($widgets as $key => $value) {
            $LibWidget = new LibWidgets();
            $LibWidget->setLibWidgetName($value);
            $LibWidget->setLibWidgetId($widgetId[$key]);
            $LibWidget->setLibWidgetId2($widgetId2[$key]);
            $manager->persist($LibWidget);
            $this->addReference('lib_widget_' . $key, $LibWidget);
        }
        $manager->flush();
    }
}
