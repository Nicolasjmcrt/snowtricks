<?php

namespace App\DataFixtures;

use App\Entity\Media;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\UserFixtures;
use App\DataFixtures\TrickFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MediaFixtures extends Fixture implements DependentFixtureInterface
{

    public const MEDIA_REFERENCE = 'media';

    public function load(ObjectManager $manager)
    {
        $media = new Media();
        $media->setCaption('Backside Air Visuel 1');
        $media->setFileName('backside_air_1.jpg');
        // this reference returns the User object created in UserFixtures
        $media->setUser($this->getReference(UserFixtures::USER_NICO));

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_BACKSIDE_AIR));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Backside Air Visuel 2');
        $media->setFileName('backside_air_2.jpg');
        // this reference returns the User object created in UserFixtures
        $media->setUser($this->getReference(UserFixtures::USER_VICTOR));

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_BACKSIDE_AIR));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Bluntslide Visuel 1');
        $media->setFileName('bluntslide_1.jpg');
        // this reference returns the User object created in UserFixtures
        $media->setUser($this->getReference(UserFixtures::USER_MAXIME));

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_BLUNTSLIDE));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Bluntslide Visuel 2');
        $media->setFileName('bluntslide_2.jpg');
        // this reference returns the User object created in UserFixtures
        $media->setUser($this->getReference(UserFixtures::USER_MAXIME));

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_BLUNTSLIDE));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Shifty Visuel 1');
        $media->setFileName('shifty_1.jpg');
        // this reference returns the User object created in UserFixtures
        $media->setUser($this->getReference(UserFixtures::USER_NICO));

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_SHIFTY));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Shifty Visuel 2');
        $media->setFileName('shifty_2.jpg');
        // this reference returns the User object created in UserFixtures
        $media->setUser($this->getReference(UserFixtures::USER_NICO));

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_SHIFTY));


        $manager->persist($media);

        $manager->flush();

    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            TrickFixtures::class
        ];
    }
}
