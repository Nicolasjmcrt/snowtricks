<?php

namespace App\Controller;

use App\Repository\MediaRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MediaController extends AbstractController
{

    /**
     * @Route("/trick/{id}-{slug}", name="show-trick")
     */
    public function show($trick, MediaRepository $mediaRepository)
    {
        $medias = $mediaRepository->findBy($trick);

        return $this->render('trick/show-trick.html.twig', [
            'medias' => $medias]);
    }
}