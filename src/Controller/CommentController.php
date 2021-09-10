<?php

namespace App\Controller;

use DateTime;
use App\Entity\Trick;
use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentController extends AbstractController
{

    /**
     * @Route("comment_add/{id}", name="comment_add")
     * @IsGranted("ROLE_USER")
     */
    public function add(Request $request, Trick $trick, EntityManagerInterface $em)
    {
        $comment = new Comment();

        

            /**@var \App\Entity\User $user */
            $user = $this->getUser();
            $comment->setUser($user);
            $comment->setContent($request->request->get('comment'));
            $comment->setTrick($trick);
            $comment->setCreationDate(new DateTime());

            $em->persist($comment);
            $em->flush();


        $referer = $request->headers->get('referer');

        return $this->redirect($referer);
    }
}
