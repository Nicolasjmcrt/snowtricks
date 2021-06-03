<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Group;

class GroupFixtures extends Fixture
{

    public const GROUP_STANCE = 'Stances';
    public const GROUP_STRAIGHT_AIR = 'Straight Airs';
    public const GROUP_GRAB = 'Grabs';
    public const GROUP_SPIN = 'Spins';
    public const GROUP_FLIP = 'Flips';
    public const GROUP_SLIDE = 'Slides';

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

        // other fixtures can get this object using the GroupFixtures::GROUP_STANCE constant
        $this->addReference(self::GROUP_STANCE, $group);

        // other fixtures can get this object using the GroupFixtures::GROUP_STRAIGHT_AIR constant
        $this->addReference(self::GROUP_STRAIGHT_AIR, $group);

        // other fixtures can get this object using the GroupFixtures::GROUP_GRAB constant
        $this->addReference(self::GROUP_GRAB, $group);

        // other fixtures can get this object using the GroupFixtures::GROUP_SPIN constant
        $this->addReference(self::GROUP_SPIN, $group);

        // other fixtures can get this object using the GroupFixtures::GROUP_FLIP constant
        $this->addReference(self::GROUP_FLIP, $group);

        // other fixtures can get this object using the GroupFixtures::GROUP_SLIDE constant
        $this->addReference(self::GROUP_SLIDE, $group);
    }
}
