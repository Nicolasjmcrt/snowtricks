<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTime;
use App\DataFixtures\UserFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{


    public function load(ObjectManager $manager)
    {
        $comment = new Comment();
        $comment->setContent('Un peu difficile à placer au début mais tellement beau !');
        $comment->setCreationDate(new DateTime ('2021-06-03 13:40:00'));
        // this reference returns the User object created in UserFixtures
        $comment->setUser($this->getReference(UserFixtures::USER_NICO));

        // this reference returns the Group object created in GroupFixtures
        $comment->setTrick($this->getReference(TrickFixtures::TRICK_BACKSIDE_AIR));

        $manager->persist($comment);

        $comment = new Comment();
        $comment->setContent('Un bon slide qui claque !');
        $comment->setCreationDate(new DateTime ('2021-06-08 11:06:00'));
        // this reference returns the User object created in UserFixtures
        $comment->setUser($this->getReference(UserFixtures::USER_NICO));

        // this reference returns the Group object created in GroupFixtures
        $comment->setTrick($this->getReference(TrickFixtures::TRICK_BLUNTSLIDE));

        $manager->persist($comment);

        $comment = new Comment();
        $comment->setContent('Toujours stylé le shifty !');
        $comment->setCreationDate(new DateTime ('2021-06-08 11:07:00'));
        // this reference returns the User object created in UserFixtures
        $comment->setUser($this->getReference(UserFixtures::USER_VICTOR));

        // this reference returns the Group object created in GroupFixtures
        $comment->setTrick($this->getReference(TrickFixtures::TRICK_SHIFTY));

        $manager->persist($comment);

        $manager->flush();

    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
    

}
