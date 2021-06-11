<?php

namespace App\DataFixtures;

use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class VideoFixtures extends Fixture
{

    

    public function load(ObjectManager $manager)
    {
        $video = new Video();
        $video->setCaption('Backside Air Video 1');
        $video->setVideoUrl('https://www.youtube.com/watch?v=hUQ3eKS13co');

        // this reference returns the Group object created in GroupFixtures
        $video->setTrick($this->getReference(TrickFixtures::TRICK_BACKSIDE_AIR));


        $manager->persist($video);

        $video = new Video();
        $video->setCaption('Tail-block Video 1');
        $video->setVideoUrl('https://www.youtube.com/watch?v=jPAsCuoRvoY');

        // this reference returns the Group object created in GroupFixtures
        $video->setTrick($this->getReference(TrickFixtures::TRICK_TAIL_BLOCK));


        $manager->persist($video);

        $video = new Video();
        $video->setCaption('Wildcat Video 1');
        $video->setVideoUrl('https://www.youtube.com/watch?v=7KUpodSrZqI');

        // this reference returns the Group object created in GroupFixtures
        $video->setTrick($this->getReference(TrickFixtures::TRICK_WILDCAT));


        $manager->persist($video);

        $video = new Video();
        $video->setCaption('Quad Cork 1800 Video 1');
        $video->setVideoUrl('https://www.youtube.com/watch?v=_MFNYVPESzA');

        // this reference returns the Group object created in GroupFixtures
        $video->setTrick($this->getReference(TrickFixtures::TRICK_QUAD_CORK_1800));


        $manager->persist($video);

        $video = new Video();
        $video->setCaption('Bluntslide 1');
        $video->setVideoUrl('https://www.youtube.com/watch?v=VIRob9RSNI8');

        // this reference returns the Group object created in GroupFixtures
        $video->setTrick($this->getReference(TrickFixtures::TRICK_BLUNTSLIDE));


        $manager->persist($video);

        $video = new Video();
        $video->setCaption('Shifty Video 1');
        $video->setVideoUrl('https://www.youtube.com/watch?v=g_Pqd6VqBOg');

        // this reference returns the Group object created in GroupFixtures
        $video->setTrick($this->getReference(TrickFixtures::TRICK_SHIFTY));


        $manager->persist($video);

        $manager->flush();

    }
}
