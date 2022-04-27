<?php


use Faker\Factory;

abstract class BaseFixture extends Fixture
{

    /** @var Generator */
    protected $faker;

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->faker = Factory::create();

    }

}
