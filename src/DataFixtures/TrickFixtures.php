<?php

namespace App\DataFixtures;

use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTime;


class TrickFixtures extends Fixture
{

    public const TRICK_BACKSIDE_AIR = 'backside_air';
    public const TRICK_TAIL_BLOCK = 'tail_block';
    public const TRICK_WILDCAT = 'wildcat';
    public const TRICK_QUAD_CORK_1800 = 'quad_cork_1800';
    public const TRICK_BLUNTSLIDE = 'bluntslide';
    public const TRICK_SHIFTY = 'shifty';

    public function load(ObjectManager $manager)
    {
        $trick = new Trick();
        $trick->setName('Backside Air');
        $trick->setDescription('On commence tout simplement avec LE trick. Les mauvaises langues prétendent qu’un backside air suffit à reconnaître ceux qui savent snowboarder. Si c’est vrai, alors Nicolas Müller est le meilleur snowboardeur du monde. Personne ne sait s’étirer aussi joliment, ne demeure aussi zen, n’est aussi provocant dans la jouissance.');
        $trick->setCreationDate(new DateTime('2021-06-03 09:40:00'));
        // this reference returns the User object created in UserFixtures
        $trick->setUser($this->getReference(UserFixtures::USER_NICO));

        // this reference returns the Group object created in GroupFixtures
        $trick->setTrickGroup($this->getReference(GroupFixtures::GROUP_GRAB));


        $manager->persist($trick);
        // other fixtures can get this object using the TrickFixtures::TRICK_BACKSIDE_AIR constant
        $this->addReference(self::TRICK_BACKSIDE_AIR, $trick);

        $trick = new Trick();
        $trick->setName('Tail-block');
        $trick->setDescription("Un Tail-bloc est un trick généralement exécuté sur la neige au sommet d'une transition, ou occasionnellement sur un objet, dans lequel le snowboarder bondit et se tient sur le tail de sa planche tout en saisissant le nez de la planche.");
        $trick->setCreationDate(new DateTime('2021-06-11 16:33:00'));
        // this reference returns the User object created in UserFixtures
        $trick->setUser($this->getReference(UserFixtures::USER_NICO));

        // this reference returns the Group object created in GroupFixtures
        $trick->setTrickGroup($this->getReference(GroupFixtures::GROUP_STALL));


        $manager->persist($trick);
        // other fixtures can get this object using the TrickFixtures::TRICK_TAIL_BLOCK constant
        $this->addReference(self::TRICK_TAIL_BLOCK, $trick);

        $trick = new Trick();
        $trick->setName('Wildcat');
        $trick->setDescription("Un Wildcat est un backflip effectué sur un saut droit, avec un axe de rotation dans lequel le snowboarder effectue un flip vers l'arrière, comme une roue de charrette. Un double wildcat est appelé un supercat.");
        $trick->setCreationDate(new DateTime('2021-06-11 16:41:00'));
        // this reference returns the User object created in UserFixtures
        $trick->setUser($this->getReference(UserFixtures::USER_NICO));

        // this reference returns the Group object created in GroupFixtures
        $trick->setTrickGroup($this->getReference(GroupFixtures::GROUP_FLIP));


        $manager->persist($trick);
        // other fixtures can get this object using the TrickFixtures::TRICK_WILDCAT constant
        $this->addReference(self::TRICK_WILDCAT, $trick);

        $trick = new Trick();
        $trick->setName('Quad Cork 1800');
        $trick->setDescription("Pour ceux qui ont du mal à comprendre le truc, un Quad Cork 1800 est un raccourci pour un saut contenant quatre flips hors axe et cinq rotations complètes.");
        $trick->setCreationDate(new DateTime('2021-06-11 16:50:00'));
        // this reference returns the User object created in UserFixtures
        $trick->setUser($this->getReference(UserFixtures::USER_NICO));

        // this reference returns the Group object created in GroupFixtures
        $trick->setTrickGroup($this->getReference(GroupFixtures::GROUP_SPIN));


        $manager->persist($trick);
        // other fixtures can get this object using the TrickFixtures::TRICK_QUAD_CORK_1800 constant
        $this->addReference(self::TRICK_QUAD_CORK_1800, $trick);

        $trick = new Trick();
        $trick->setName('Bluntslide');
        $trick->setDescription("Une glissade effectuée lorsque le pied avant du rider passe sur le rail à l'approche, avec son snowboard se déplaçant perpendiculairement et le pied arrière directement au-dessus du rail ou d'un autre obstacle (comme un tailslide). Lors de l'exécution d'un frontside bluntslide, le snowboarder fait face à la montée. Lors de l'exécution d'un backside bluntslide, le snowboarder fait face à la descente.");
        $trick->setCreationDate(new DateTime('2021-06-08 10:31:00'));
        // this reference returns the User object created in UserFixtures
        $trick->setUser($this->getReference(UserFixtures::USER_VICTOR));

        // this reference returns the Group object created in GroupFixtures
        $trick->setTrickGroup($this->getReference(GroupFixtures::GROUP_SLIDE));


        $manager->persist($trick);
        // other fixtures can get this object using the TrickFixtures::TRICK_BLUNTSLIDE constant
        $this->addReference(self::TRICK_BLUNTSLIDE, $trick);

        $trick = new Trick();
        $trick->setName('Shifty');
        $trick->setDescription("Un Shifty est un trick aérien dans lequel un snowboarder fait contre-rotation avec le haut de son corps afin de déplacer sa planche d'environ 90° par rapport à sa position normale sous lui, puis ramène la planche à sa position d'origine avant d'atterrir. Ce tour peut être réalisé en frontside ou backside, mais aussi en variation avec d'autres tricks and spins.");
        $trick->setCreationDate(new DateTime('2021-06-08 10:55:00'));
        // this reference returns the User object created in UserFixtures
        $trick->setUser($this->getReference(UserFixtures::USER_MAXIME));

        // this reference returns the Group object created in GroupFixtures
        $trick->setTrickGroup($this->getReference(GroupFixtures::GROUP_STRAIGHT_AIR));


        $manager->persist($trick);
        // other fixtures can get this object using the TrickFixtures::TRICK_SHIFTY constant
        $this->addReference(self::TRICK_SHIFTY, $trick);

        $manager->flush();

        
    }
}
