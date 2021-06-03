<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Group;

class GroupFixtures extends Fixture
{

    public const GROUP_REFERENCE = 'trick-group';

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

        // other fixtures can get this object using the UserFixtures::GROUP_REFERENCE constant
        $this->addReference(self::GROUP_REFERENCE, $group);
    }
}
