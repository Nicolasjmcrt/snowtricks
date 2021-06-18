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
        $media->setDisplayOrder(1);

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_BACKSIDE_AIR));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Backside Air Visuel 2');
        $media->setFileName('backside_air_2.jpg');
        $media->setDisplayOrder(2);

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_BACKSIDE_AIR));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Bloddy Dracula 1');
        $media->setFileName('bloody_dracula_1.jpg');
        $media->setDisplayOrder(1);

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_BLOODY_DRACULA));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Bloddy Dracula 2');
        $media->setFileName('bloody_dracula_2.jpg');
        $media->setDisplayOrder(2);

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_BLOODY_DRACULA));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Tail-block Visuel 1');
        $media->setFileName('tail_block_1.jpg');
        $media->setDisplayOrder(1);

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_TAIL_BLOCK));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Tail-block Visuel 2');
        $media->setFileName('tail_block_2.jpg');
        $media->setDisplayOrder(2);

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_TAIL_BLOCK));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Wildcat Visuel 1');
        $media->setFileName('wildcat_1.jpg');
        $media->setDisplayOrder(1);

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_WILDCAT));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Wildcat Visuel 2');
        $media->setFileName('wildcat_2.jpg');
        $media->setDisplayOrder(2);

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_WILDCAT));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Backflip Visuel 1');
        $media->setFileName('backflip_1.jpg');
        $media->setDisplayOrder(1);

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_BACKFLIP));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Backflip Visuel 2');
        $media->setFileName('backflip_2.jpg');
        $media->setDisplayOrder(2);

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_BACKFLIP));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Tamedog Visuel 1');
        $media->setFileName('tamedog_1.jpg');
        $media->setDisplayOrder(1);

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_TAMEDOG));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Tamedog Visuel 2');
        $media->setFileName('tamedog_2.jpg');
        $media->setDisplayOrder(2);

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_TAMEDOG));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Quad Cork 1800 Visuel 1');
        $media->setFileName('quad_cork_1800_1.jpg');
        $media->setDisplayOrder(1);

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_QUAD_CORK_1800));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Quad Cork 1800 Visuel 2');
        $media->setFileName('quad_cork_1800_2.jpg');
        $media->setDisplayOrder(2);

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_QUAD_CORK_1800));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Bluntslide Visuel 1');
        $media->setFileName('bluntslide_1.jpg');
        $media->setDisplayOrder(1);

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_BLUNTSLIDE));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Bluntslide Visuel 2');
        $media->setFileName('bluntslide_2.jpg');
        $media->setDisplayOrder(2);

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_BLUNTSLIDE));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Nosepress Visuel 1');
        $media->setFileName('nosepress_1.jpg');
        $media->setDisplayOrder(1);

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_NOSEPRESS));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Nosepress Visuel 2');
        $media->setFileName('nosepress_2.jpg');
        $media->setDisplayOrder(2);

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_NOSEPRESS));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Shifty Visuel 1');
        $media->setFileName('shifty_1.jpg');
        $media->setDisplayOrder(1);

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_SHIFTY));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Shifty Visuel 2');
        $media->setFileName('shifty_2.jpg');
        $media->setDisplayOrder(2);

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_SHIFTY));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Air-to-Fakie Visuel 1');
        $media->setFileName('air_to_fakie_1.jpg');
        $media->setDisplayOrder(1);

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_AIR_TO_FAKIE));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('Air-to-Fakie Visuel 2');
        $media->setFileName('air_to_fakie_2.jpg');
        $media->setDisplayOrder(2);

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_AIR_TO_FAKIE));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('poptart Visuel 1');
        $media->setFileName('poptart_1.jpg');
        $media->setDisplayOrder(1);

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_POPTART));


        $manager->persist($media);

        $media = new Media();
        $media->setCaption('poptart Visuel 2');
        $media->setFileName('poptart_2.jpg');
        $media->setDisplayOrder(2);

        // this reference returns the Group object created in GroupFixtures
        $media->setTrick($this->getReference(TrickFixtures::TRICK_POPTART));


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
