<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Service\TrickMedia;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrickController extends AbstractController
{
    /**
     * @Route("/",name="trick_home")
     */
    public function index(TrickMedia $trickMedia)
    {
        $tricks = $trickMedia->getTricks();
        dump($tricks);

        return $this->render('trick/index.html.twig', ['tricks' => $tricks]);
    }

    
}