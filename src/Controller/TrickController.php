<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\Trick;
use App\Form\TrickType;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
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
    public function show($id, TrickRepository $trickRepository)
    {
        $trick = $trickRepository->findOneBy([
            'id' => $id
        ]);

        return $this->render('trick/show-trick.html.twig', ['trick' => $trick]);
    }

    /**
     * @Route("/create", name="trick_create")
     */
    public function create(Request $request, SluggerInterface $slugger, EntityManagerInterface $em)
    {

        $trick =new Trick();

        // Construction du formulaire à l'aide du TrickType
        $form = $this->createForm(TrickType::class, $trick);

        // Gestion de la saisie du formulaire
        $form->handleRequest($request);

        // Verification de la soumission et validité du formulaire
        if ($form->isSubmitted()) {

            // // Construction du slug
            // $trick = $form->getData();
            $medias = $trick->getTrickMedia();

            dump($medias);
            $trick->setSlug(strtolower($slugger->slug($trick->getName())));
            $user = $em->getRepository(User::class)->find(1);
            $trick->setUser($user);
            // $trick->setUser($this->getUser());
            $trick->setCreationDate(new DateTime());
            // Préparation des données recueillies et injection dans la bdd
            $em->persist($trick);
            $em->flush();

            // Génération URL + redirection
            // return $this->redirectToRoute('show-trick', [
            //     'id' => $trick->getId(),
            //     'slug' => $trick->getSlug()
            // ]);
        }

        // Création du rendu du formulaire pour Twig
        $formView = $form->createView();

        return $this->render('trick/create.html.twig', [
            'formView' => $formView
        ]);
    }

    /**
     * @Route("/edit/{id}-{slug}", name="edit-trick")
     */
    public function edit($id, TrickRepository $trickRepository, Request $request, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator)
    {
        
        $trick = $trickRepository->find($id);

        $form = $this->createForm(TrickType::class);

        // $form->setData($trick);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em->flush();

            
            // Génération URL + redirection
            return $this->redirectToRoute('show-trick', [
                'id' => $trick->getId(),
                'slug' => $trick->getSlug()
            ]);
        }

        

        $formView = $form->createView();

        return $this->render('trick/edit-page.html.twig', [
            'trick' => $trick,
            'formView' => $formView
    ]);
    }

    /**
     * @Route("/delete-trick/{id}",name="delete_trick", requirements={"id"="\d+"})
     */
    public function delete_trick($id, Request $request)
    {
        if ($request->isXmlHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            $trick = $em->getRepository(Trick::class)->find($id);
            $em->remove($trick);
            $em->flush();
        }
        return $this->redirectToRoute('trick_home');
    }
}
