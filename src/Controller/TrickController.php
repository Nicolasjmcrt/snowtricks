<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Service\TrickMedia;
use App\Repository\UserRepository;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

        return $this->render('trick/trick-page.html.twig', ['trick' => $trick]);
    }

    /**
     * @Route("/edit/{id}-{slug}", name="edit-trick")
     */
    public function edit(Trick $trick)
    {

        return $this->render('trick/edit-page.html.twig', ['trick' => $trick]);
    }

    /**
     * @Route("/delete-trick/{id}",name="delete_trick", requirements={"id"="\d+"})
     */
    public function delete_trick($id, Request $request, EntityManagerInterface $em)
    {
        if ($request->isXmlHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            $trick = $em->getRepository(Trick::class)->find($id);
            $em->remove($trick);
            $em->flush();
            

            return $this->redirectToRoute('trick_home');
        }
    }

}
