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
        $video->setCaption('Bloody Dracula 1');
        $video->setVideoUrl('https://www.youtube.com/watch?v=UU9iKINvlyU');

        // this reference returns the Group object created in GroupFixtures
        $video->setTrick($this->getReference(TrickFixtures::TRICK_BLOODY_DRACULA));


        $manager->persist($video);

        $video = new Video();
        $video->setCaption('Chicken Salad 1');
        $video->setVideoUrl('https://www.youtube.com/watch?v=TTgeY_XCvkQ');

        // this reference returns the Group object created in GroupFixtures
        $video->setTrick($this->getReference(TrickFixtures::TRICK_CHICKEN_SALAD));


        $manager->persist($video);

        $video = new Video();
        $video->setCaption('Drunk Driver 1');
        $video->setVideoUrl('https://www.youtube.com/watch?v=6tgjY8baFT0');

        // this reference returns the Group object created in GroupFixtures
        $video->setTrick($this->getReference(TrickFixtures::TRICK_DRUNK_DRIVER));


        $manager->persist($video);

        $video = new Video();
        $video->setCaption('Roast Beef 1');
        $video->setVideoUrl('https://www.youtube.com/watch?v=5ylWnm4rF1o');

        // this reference returns the Group object created in GroupFixtures
        $video->setTrick($this->getReference(TrickFixtures::TRICK_ROAST_BEEF));


        $manager->persist($video);

        $video = new Video();
        $video->setCaption('Tail-grab 1');
        $video->setVideoUrl('https://www.youtube.com/watch?v=id8VKl9RVQw');

        // this reference returns the Group object created in GroupFixtures
        $video->setTrick($this->getReference(TrickFixtures::TRICK_TAIL_GRAB));


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
        $video->setCaption('Backflip Video 1');
        $video->setVideoUrl('https://www.youtube.com/watch?v=arzLq-47QFA');

        // this reference returns the Group object created in GroupFixtures
        $video->setTrick($this->getReference(TrickFixtures::TRICK_BACKFLIP));


        $manager->persist($video);

        $video = new Video();
        $video->setCaption('Tamedog Video 1');
        $video->setVideoUrl('https://www.youtube.com/watch?v=qvnsjVJCbA0');

        // this reference returns the Group object created in GroupFixtures
        $video->setTrick($this->getReference(TrickFixtures::TRICK_TAMEDOG));


        $manager->persist($video);

        $video = new Video();
        $video->setCaption('Frontside Rodeo Video 1');
        $video->setVideoUrl('https://www.youtube.com/watch?v=32y1VcGgm-Y');

        // this reference returns the Group object created in GroupFixtures
        $video->setTrick($this->getReference(TrickFixtures::TRICK_FRONTSIDE_RODEO));


        $manager->persist($video);

        $video = new Video();
        $video->setCaption('Mc Twist Video 1');
        $video->setVideoUrl('https://www.youtube.com/watch?v=k-CoAquRSwY');

        // this reference returns the Group object created in GroupFixtures
        $video->setTrick($this->getReference(TrickFixtures::TRICK_MC_TWIST));


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
        $video->setCaption('Nosepress 1');
        $video->setVideoUrl('https://www.youtube.com/watch?v=Px2YuKQVS_g');

        // this reference returns the Group object created in GroupFixtures
        $video->setTrick($this->getReference(TrickFixtures::TRICK_NOSEPRESS));


        $manager->persist($video);

        $video = new Video();
        $video->setCaption('Gutterball 1');
        $video->setVideoUrl('https://www.youtube.com/watch?v=evMsZSr6hGM');

        // this reference returns the Group object created in GroupFixtures
        $video->setTrick($this->getReference(TrickFixtures::TRICK_GUTTERBALL));


        $manager->persist($video);

        $video = new Video();
        $video->setCaption('Lipslide 1');
        $video->setVideoUrl('https://www.youtube.com/watch?v=LSVn5aI56aU');

        // this reference returns the Group object created in GroupFixtures
        $video->setTrick($this->getReference(TrickFixtures::TRICK_LIPSLIDE));


        $manager->persist($video);

        $video = new Video();
        $video->setCaption('Shifty Video 1');
        $video->setVideoUrl('https://www.youtube.com/watch?v=g_Pqd6VqBOg');

        // this reference returns the Group object created in GroupFixtures
        $video->setTrick($this->getReference(TrickFixtures::TRICK_SHIFTY));


        $manager->persist($video);

        $video = new Video();
        $video->setCaption('Air-to-Fakie Video 1');
        $video->setVideoUrl('https://www.youtube.com/watch?v=2fP_R0tXFAc');

        // this reference returns the Group object created in GroupFixtures
        $video->setTrick($this->getReference(TrickFixtures::TRICK_AIR_TO_FAKIE));


        $manager->persist($video);

        $manager->flush();

    }
}
