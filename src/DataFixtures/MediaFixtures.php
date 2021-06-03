<?php

namespace App\DataFixtures;

use App\Entity\Media;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class MediaFixtures extends Fixture
{

    public const MEDIA_REFERENCE = 'media';

    public function load(ObjectManager $manager)
    {
        $media = new Media();
        $media->setCaption('Backside Air Visuel 1');
        $media->setFileName('backside_air_1.jpg');
        // this reference returns the User object created in UserFixtures
        $media->setUser($this->getReference(UserFixtures::USER_REFERENCE));

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_REFERENCE));


        $manager->persist($media);

        $manager->flush();

    }
}
