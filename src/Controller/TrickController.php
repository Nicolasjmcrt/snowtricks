<?php

namespace App\Controller;

use App\Entity\Comment;
use DateTime;
use App\Entity\User;
use App\Entity\Media;
use App\Entity\Trick;
use App\Entity\Video;
use App\Form\CommentType;
use App\Form\TrickType;
use App\Repository\CommentRepository;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TrickController extends AbstractController
{
    /**
     * @Route("/",name="trick_home")
     */
    public function index(TrickRepository $trickRepository)
    {
        $tricks = $trickRepository->findBy([], ['creationDate' => 'DESC'], 15, 0);
        $trickCount = $trickRepository->count([]);
        return $this->render('trick/index.html.twig', [
            'tricks' => $tricks,
            'trickCount' => $trickCount
        ]);
    }

    /**
     * @Route("/load-more/{start}",name="load_more")
     */
    public function load_more(Request $request, TrickRepository $trickRepository, $start = 15)
    {
        if ($request->isXmlHttpRequest()) {

            $tricks = $trickRepository->findBy([], ['creationDate' => 'DESC'], 5, $start);

            return $this->render('trick/tricks-list.html.twig', [
                'tricks' => $tricks
            ]);
        }
    }

    /**
     * @Route("/trick/{id}-{slug}", name="show-trick")
     */
    public function show($id, TrickRepository $trickRepository, Request $request, EntityManagerInterface $em, CommentRepository $commentRepository)
    {
        $trick = $trickRepository->findOneBy([
            'id' => $id
        ]);

        // $comments = $commentRepository->findBy([$trick], ['creationDate' => 'DESC'], 2, 0);

        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);

        // Gestion de la saisie du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /**@var \App\Entity\User $user */
            $user = $this->getUser();
            $comment->setUser($user);
            $comment->setTrick($trick);
            $comment->setCreationDate(new DateTime());

            $em->persist($comment);
            $em->flush();

        };

        $formView = $form->createView();

        return $this->render('trick/show-trick.html.twig', [
            'trick' => $trick,
            'formView' => $formView,
            'comment' => $comment]);
    }

    /**
     * @Route("/create", name="trick_create")
     * @IsGranted("ROLE_USER")
     */
    public function create(Request $request, SluggerInterface $slugger, EntityManagerInterface $em)
    {

        $trick = new Trick();

        // Construction du formulaire à l'aide du TrickType
        $form = $this->createForm(TrickType::class, $trick);

        // Gestion de la saisie du formulaire
        $form->handleRequest($request);

        // Verification de la soumission et validité du formulaire
        if ($form->isSubmitted() && $form->isValid()) {

            $trick->setSlug(strtolower($slugger->slug($trick->getName())));
            
            /**@var \App\Entity\User $user */
            $user = $this->getUser();

            $trick->setUser($user);
            
            // $trick->setUser($this->getUser());
            $trick->setCreationDate(new DateTime());

            $medias = $trick->getTrickMedia();

            foreach ($medias as $media) {
                $trickMedia = new Media();
                $trickMedia->setFileName($media->getFileName());
                $trickMedia->setCaption($media->getCaption());
                $trickMedia->setTrick($trick);
                $em->persist($trickMedia);
            }

            $videos = $form->get('videos')->getData();

            foreach ($videos as $video) {
                $trickVideo = new Video();
                $trickVideo->setVideoUrl($video->getVideoUrl());
                $trickVideo->setCaption($video->getCaption());
                $trickVideo->setTrick($trick);
                $em->persist($trickVideo);
            }
            // Préparation des données recueillies et injection dans la bdd
            $em->persist($trick);
            $em->flush();

            // Génération URL + redirection
            return $this->redirectToRoute('show-trick', [
                'id' => $trick->getId(),
                'slug' => $trick->getSlug()
            ]);
        }


        // Création du rendu du formulaire pour Twig
        $formView = $form->createView();

        return $this->render('trick/create.html.twig', [
            'formView' => $formView
        ]);
    }

    /**
     * @Route("/edit/{id}-{slug}", name="edit-trick", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function edit(Trick $trick, Request $request, EntityManagerInterface $em, ValidatorInterface $validator): Response
    {

        $form = $this->createForm(TrickType::class, $trick);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();


            // Génération URL + redirection
            return $this->redirectToRoute('show-trick', [
                'id' => $trick->getId(),
                'slug' => $trick->getSlug()
            ]);
        }

        return $this->render('trick/edit-page.html.twig', [
            'trick' => $trick,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete-trick/{id}",name="delete_trick", requirements={"id"="\d+"})
     * @IsGranted("ROLE_USER")
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
