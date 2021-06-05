<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrickController extends AbstractController
{
    /**
     * @Route("/",name="trick_home")
     */
    public function index(TrickRepository $trickRepository)
    {
        $tricks = $trickRepository->findAll();
        dump($tricks);

        return $this->render('trick/index.html.twig');
    }

    
}