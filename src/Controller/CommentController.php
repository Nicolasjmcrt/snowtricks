<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentController extends AbstractController
{

    /**
     * @Route("/trick/{id}-{slug}", name="show-trick")
     */
    public function show($trick, CommentRepository $commentRepository)
    {
        $comments = $commentRepository->findBy($trick, ['creationDate' => 'ASC'], 2, []);

        return $this->render('trick/show-trick.html.twig', ['comments' => $comments]);
    }
}
