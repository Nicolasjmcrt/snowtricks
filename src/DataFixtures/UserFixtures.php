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

    public const USER_REFERENCE = 'user';

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

        $manager->flush();

        // other fixtures can get this object using the UserFixtures::USER_REFERENCE constant
        $this->addReference(self::USER_REFERENCE, $user);
    }
}
