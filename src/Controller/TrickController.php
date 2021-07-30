<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Service\TrickMedia;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class TrickController extends AbstractController
{
    /**
     * @Route("/",name="trick_home")
     */
    public function index(TrickMedia $trickMedia)
    {
        $tricks = $trickMedia->getTricks();
        return $this->render('trick/index.html.twig', ['tricks' => $tricks]);
    }

    /**
     * @Route("/load-more",name="load_more")
     */
    public function load_more(Request $request, TrickMedia $trickMedia)
    {
       if ($request->isXmlHttpRequest()) {
            $tricks = $trickMedia->getTricks();
           return $this->render('trick/tricks.html.twig', ['tricks' => $tricks]);
       }
    }
    
}