<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\Media;
use App\Entity\Trick;
use App\Entity\Video;
use App\Entity\Comment;
use App\Form\TrickType;
use App\Form\CommentType;
use App\Repository\TrickRepository;
use App\Repository\CommentRepository;
use App\Repository\MediaRepository;
use App\Service\DisplayOrder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class TrickController extends AbstractController
{
    /**
     * @Route("/",name="trick_home")
     */
    public function index(TrickRepository $trickRepository)
    {
        /**@var \App\Entity\User $user */
        $user = $this->getUser();

        $tricks = $trickRepository->findBy([], ['creationDate' => 'DESC'], 15, 0);
        $trickCount = $trickRepository->count([]);

        return $this->render('trick/index.html.twig', [
            'user' => $user,
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
    public function show($id, TrickRepository $trickRepository, MediaRepository $mediaRepository, CommentRepository $commentRepository)
    {
        $trick = $trickRepository->findOneBy([
            'id' => $id
        ]);

        $trickId = $trick->getId();


        $comments = $commentRepository->findByTrick($trickId, ['creationDate' => 'DESC'], 5, 0);

        $commentCount = $commentRepository->count([]);

        /** @var \App\Entity\User $user */
        $user = $this->getUser();



        return $this->render('trick/show-trick.html.twig', [
            'trick' => $trick,
            'user' => $user,
            'comments' => $comments,
            'commentCount' => $commentCount
        ]);
    }

    

    /**
     * @Route("/create", name="trick_create")
     * @IsGranted("ROLE_USER")
     */
    public function create(Request $request, SluggerInterface $slugger, EntityManagerInterface $em, SessionInterface $session)
    {

        /** @var \App\Entity\User $user */
        $user = $this->getUser();

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

            $trick->setCreationDate(new DateTime());


            $mediaForms = $form->get('trickMedia');

            $mediaFileCount = 1;

            foreach ($mediaForms as $mediaForm) {


                /** @var UploadedFile $mediaFile */
                $mediaFile = $mediaForm->get('fileName')->getData();
                $mediaFileName = uniqid() . '.' . $mediaFile->guessExtension();

                $media = $mediaForm->getData();
                // Copie du fichier dans le dossier media/trick
                $mediaFile->move(
                    $this->getParameter('medias_directory'),
                    $mediaFileName
                );

                $trickMedia = new Media();
                $trickMedia->setFileName($mediaFileName);
                $trick->addTrickMedium($trickMedia);
                $trickMedia->setCaption($media->getCaption());
                $trickMedia->setTrick($trick);
                $trickMedia->setDisplayOrder($mediaFileCount++);
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

            /** @var FlashBag */
            $flashBag = $session->getBag('flashes');

            $flashBag->add('success', "Le trick a bien été créé !");

            // Génération URL + redirection
            return $this->redirectToRoute('trick_home', [
                '_fragment' => 'trick-section'
            ]);
        }


        // Création du rendu du formulaire pour Twig
        $formView = $form->createView();

        return $this->render('trick/create.html.twig', [
            'formView' => $formView,
            'user' => $user
        ]);
    }

    /**
     * @Route("/edit/{id}-{slug}", name="edit-trick", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function edit(Trick $trick, Request $request, EntityManagerInterface $em, ValidatorInterface $validator, SessionInterface $session, MediaRepository $mediaRepository, DisplayOrder $displayOrder): Response
    {

        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $form = $this->createForm(TrickType::class, $trick);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /**@var \App\Entity\User $user */
            $user = $this->getUser();

            $trick->setUser($user);

            $trick->setEditedAt(new DateTime());


            $mediaForms = $form->get('trickMedia');


            $mediaFileCount = $displayOrder->getLastDisplay($trick->getId());

            foreach ($mediaForms as $mediaForm) {


                /** @var UploadedFile $mediaFile */
                $mediaFile = $mediaForm->get('fileName')->getData();
                $mediaFileName = uniqid() . '.' . $mediaFile->guessExtension();

                $media = $mediaForm->getData();
                // Copie du fichier dans le dossier media/trick
                $mediaFile->move(
                    $this->getParameter('medias_directory'),
                    $mediaFileName
                );

                $trickMedia = new Media();
                $trickMedia->setFileName($mediaFileName);
                $trick->addTrickMedium($trickMedia);
                $trickMedia->setCaption($media->getCaption());
                $trickMedia->setTrick($trick);
                $trickMedia->setDisplayOrder($mediaFileCount++);
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

            $em->flush();

            /** @var FlashBag */
            $flashBag = $session->getBag('flashes');

            $flashBag->add('success', "Le trick a bien été modifié !");


            // Génération URL + redirection
            // return $this->redirectToRoute('show-trick', [
            //     'id' => $trick->getId(),
            //     'slug' => $trick->getSlug()
            // ]);
        }

        return $this->render('trick/edit-page.html.twig', [
            'trick' => $trick,
            'form' => $form->createView(),
            'user' => $user
        ]);
    }

    /**
     * @Route("/delete-trick/{id}",name="delete_trick", requirements={"id"="\d+"})
     * @IsGranted("ROLE_USER")
     */
    public function delete_trick($id, Request $request, SessionInterface $session)
    {
        if ($request->isXmlHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            $trick = $em->getRepository(Trick::class)->find($id);
            $em->remove($trick);
            $em->flush();

            /** @var FlashBag */
            $flashBag = $session->getBag('flashes');

            $flashBag->add('success', "Le trick a bien été supprimé !");

            return $this->redirectToRoute('trick_home');
        }
    }

    /**
     * @Route("delete/media/{id}", name="delete_media", methods={"DELETE"})
     * @IsGranted("ROLE_USER")
     */
    public function delete_media(Media $media, Request $request, EntityManagerInterface $em)
    {
        $data = json_decode($request->getContent(), true);

        // Vérification de la validité du token
        if ($this->isCsrfTokenValid('delete' . $media->getId(), $data['_token'])) {
            // Récupération du nom de l'image
            $name = $media->getFileName();
            // Suppression du fichier
            unlink($this->getParameter('medias_directory') . '/' . $name);

            // Suppression de l'entrée de la base
            $em->remove($media);
            $em->flush();

            // Réponse en JSON
            return new JsonResponse(['success' => 1]);
        } else {
            return new JsonResponse(['error' => 'Token invalide'], 400);
        }
    }

    /**
     * @Route("delete/video/{id}", name="delete_video", methods={"DELETE"})
     * @IsGranted("ROLE_USER")
     */
    public function delete_video(Video $video, Request $request, EntityManagerInterface $em)
    {
        $data = json_decode($request->getContent(), true);

        // Vérification de la validité du token
        if ($this->isCsrfTokenValid('delete' . $video->getId(), $data['_token'])) {

            // Suppression de l'entrée de la base
            $em->remove($video);
            $em->flush();

            // Réponse en JSON
            return new JsonResponse(['success' => 1]);
        } else {
            return new JsonResponse(['error' => 'Token invalide'], 400);
        }
    }
    
}
