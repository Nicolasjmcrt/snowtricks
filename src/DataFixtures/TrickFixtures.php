<?php

namespace App\DataFixtures;

use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTime;


class TrickFixtures extends Fixture
{

    public const TRICK_REFERENCE = 'trick';

    public function load(ObjectManager $manager)
    {
        $trick = new Trick();
        $trick->setName('Backside Air');
        $trick->setDescription('On commence tout simplement avec LE trick. Les mauvaises langues prétendent qu’un backside air suffit à reconnaître ceux qui savent snowboarder. Si c’est vrai, alors Nicolas Müller est le meilleur snowboardeur du monde. Personne ne sait s’étirer aussi joliment, ne demeure aussi zen, n’est aussi provocant dans la jouissance.');
        $trick->setCreationDate(new DateTime('2021-06-03 09:40:00'));
        // this reference returns the User object created in UserFixtures
        $trick->setUser($this->getReference(UserFixtures::USER_REFERENCE));

        // this reference returns the Group object created in GroupFixtures
        $trick->setTrickGroup($this->getReference(GroupFixtures::GROUP_REFERENCE));


        $manager->persist($trick);

        $manager->flush();

        // other fixtures can get this object using the TrickFixtures::TRICK_REFERENCE constant
        $this->addReference(self::TRICK_REFERENCE, $trick);
    }
}
