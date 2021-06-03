<?php

namespace App\DataFixtures;

use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class MediaFixtures extends Fixture
{

    

    public function load(ObjectManager $manager)
    {
        $video = new Video();
        $video->setCaption('Backside Air Video 1');
        $video->setVideoUrl('https://www.youtube.com/watch?v=hUQ3eKS13co');

        // this reference returns the Group object created in GroupFixtures
        $video->setTrick($this->getReference(TrickFixtures::TRICK_REFERENCE));


        $manager->persist($video);

        $manager->flush();

    }
}
