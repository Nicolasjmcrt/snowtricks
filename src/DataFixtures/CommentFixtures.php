<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTime;


class CommentFixtures extends Fixture
{


    public function load(ObjectManager $manager)
    {
        $comment = new Comment();
        $comment->setContent('Un peu difficile à placer au début mais tellement beau !');
        $comment->setCreationDate(new DateTime ('2021-06-03 13:40:00'));
        // this reference returns the User object created in UserFixtures
        $comment->setUser($this->getReference(UserFixtures::USER_REFERENCE));

        // this reference returns the Group object created in GroupFixtures
        $comment->setTrick($this->getReference(TrickFixtures::TRICK_REFERENCE));

        $manager->persist($comment);

        $manager->flush();

    }
}
