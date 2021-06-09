<?php

namespace App\DataFixtures;

use App\Entity\Group;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GroupFixtures extends Fixture
{

    public const GROUP_STALL = 'Stalls';
    public const GROUP_STRAIGHT_AIR = 'Straight Airs';
    public const GROUP_GRAB = 'Grabs';
    public const GROUP_SPIN = 'Spins';
    public const GROUP_FLIP = 'Flips';
    public const GROUP_SLIDE = 'Slides';

    public function load(ObjectManager $manager)
    {

        $group = new Group();
        $group->setName('Stalls');

        $manager->persist($group);

        // other fixtures can get this object using the GroupFixtures::GROUP_STALL constant
        $this->addReference(self::GROUP_STALL, $group);

        $group = new Group();
        $group->setName('Straight Airs');

        $manager->persist($group);
        // other fixtures can get this object using the GroupFixtures::GROUP_STRAIGHT_AIR constant
        $this->addReference(self::GROUP_STRAIGHT_AIR, $group);

        $group = new Group();
        $group->setName('Grabs');

        $manager->persist($group);
        // other fixtures can get this object using the GroupFixtures::GROUP_GRAB constant
        $this->addReference(self::GROUP_GRAB, $group);

        $group = new Group();
        $group->setName('Spins');

        $manager->persist($group);
        // other fixtures can get this object using the GroupFixtures::GROUP_SPIN constant
        $this->addReference(self::GROUP_SPIN, $group);

        $group = new Group();
        $group->setName('Flips');

        $manager->persist($group);
        // other fixtures can get this object using the GroupFixtures::GROUP_FLIP constant
        $this->addReference(self::GROUP_FLIP, $group);

        $group = new Group();
        $group->setName('Slides');

        $manager->persist($group);
        // other fixtures can get this object using the GroupFixtures::GROUP_SLIDE constant
        $this->addReference(self::GROUP_SLIDE, $group);

        $manager->flush();

    }
}
