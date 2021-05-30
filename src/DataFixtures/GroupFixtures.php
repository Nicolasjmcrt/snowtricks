<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Group;

class GroupFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $groups = [
            'Stances', 
            'Straight Airs', 
            'Grabs', 
            'Spins', 
            'Flips', 
            'Slides'
        ];

        foreach ($groups as $key => $value) {

            $group = new Group();
            $group->setName($value);

            $manager->persist($group);
        }

        

        $manager->flush();
    }
}
