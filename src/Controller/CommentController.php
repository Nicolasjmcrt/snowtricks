<?php

namespace App\Controller;

use DateTime;
use App\Entity\Trick;
use App\Entity\Comment;
use App\Repository\TrickRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentController extends AbstractController
{

    /**
     * @Route("comment_add/{id}", name="comment_add")
     * @IsGranted("ROLE_USER")
     */
    public function add(Request $request, Trick $trick, EntityManagerInterface $em, SessionInterface $session)
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

            /** @var FlashBag */
            $flashBag = $session->getBag('flashes');

            $flashBag->add('success', "Le commentaire a bien été ajouté !");


        $referer = $request->headers->get('referer');

        return $this->redirect($referer);
    }

    /**
     * @Route("/load-more-comments/{id}/{start}",name="load_more_comments")
     */
    public function load_more_comments(Request $request, CommentRepository $commentRepository, $start = 5, $id =0)
    {
       


        if ($request->isXmlHttpRequest()) {

            $comments = $commentRepository->findByTrick($id, ['creationDate' => 'DESC'], 5, $start);

            return $this->render('comment/comments-list.html.twig', [
                'comments' => $comments
            ]);
        }
    }
}
