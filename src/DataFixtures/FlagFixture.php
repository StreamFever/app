<?php


class FlagFixture extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Flags::class, 10, function(Flags $flags, $count) {

           
        });

    }
}
