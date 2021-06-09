<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTime;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public const USER_NICO = 'nico';
    public const USER_VICTOR = 'victor';
    public const USER_MAXIME = 'maxime';

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setFirstName('Nicolas');
        $user->setLastName('Jumeaucourt');
        $user->setEmail('jumeaucourtn@gmail.com');
        $user->setCreationDate(new DateTime('2021-05-30 11:28:00'));
        $user->setTokenDate(new DateTime('2021-05-30 11:28:00'));

        $password = $this->encoder->encodePassword($user, 'pass_1234');
        $user->setPassword($password);

        $manager->persist($user);
        // other fixtures can get this object using the UserFixtures::USER_NICO constant
        $this->addReference(self::USER_NICO, $user);

        $user = new User();
        $user->setFirstName('Victor');
        $user->setLastName('Jumeaucourt');
        $user->setEmail('jumeaucourtv@gmail.com');
        $user->setCreationDate(new DateTime('2021-06-07 10:50:00'));
        $user->setTokenDate(new DateTime('2021-06-07 10:50:00'));

        $password = $this->encoder->encodePassword($user, 'pass_4321');
        $user->setPassword($password);

        $manager->persist($user);
        // other fixtures can get this object using the UserFixtures::USER_VICTOR constant
        $this->addReference(self::USER_VICTOR, $user);

        $user = new User();
        $user->setFirstName('Maxime');
        $user->setLastName('Jumeaucourt');
        $user->setEmail('jumeaucourtmx@gmail.com');
        $user->setCreationDate(new DateTime('2021-06-07 11:14:00'));
        $user->setTokenDate(new DateTime('2021-06-07 11:14:00'));

        $password = $this->encoder->encodePassword($user, 'pass_1234');
        $user->setPassword($password);

        $manager->persist($user);
        // other fixtures can get this object using the UserFixtures::USER_MAXIME constant
        $this->addReference(self::USER_MAXIME, $user);

        $manager->flush();

        
    }
}
