<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Repository\TrickRepository;
use App\Service\TrickMedia;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class TrickController extends AbstractController
{
    /**
     * @Route("/",name="trick_home")
     */
    public function index(TrickRepository $trickRepository)
    {
        $tricks = $trickRepository->findBy([], ['creationDate' => 'DESC'], 15, 0);
        $trickCount = $trickRepository->count([]);
        return $this->render('trick/index.html.twig', ['tricks' => $tricks, 'trickCount' => $trickCount]);
    }

    /**
     * @Route("/load-more/{start}",name="load_more")
     */
    public function load_more(Request $request, TrickRepository $trickRepository, $start = 15)
    {
        if ($request->isXmlHttpRequest()) {

            $tricks = $trickRepository->findBy([], ['creationDate' => 'DESC'], 5, $start);

            return $this->render('trick/tricks-list.html.twig', ['tricks' => $tricks]);
        }
    }

    /**
     * @Route("/trick/{id}-{slug}", name="show-trick")
     */
    public function trick(Trick $trick)
    {
        dump($trick);
    }
}
