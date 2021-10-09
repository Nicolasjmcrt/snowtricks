<?php

namespace App\Controller;

use App\Repository\MediaRepository;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/change_display_order/{id}",name="change_display_order")
     */
    public function change_display_order(Request $request, MediaRepository $mediaRepository, $id =0)
    {
       
        // if ($request->isXmlHttpRequest()) {

            $newFeaturedPicture = $mediaRepository->findById($id);

            $oldFeaturedPicture = $mediaRepository->findByTrick($newFeaturedPicture[0]->getTrick()->getId());

            // dump($newFeaturedPicture);

            // dump($oldFeaturedPicture);

            // $oldFeaturedPicture->setDisplayOrder($newFeaturedPicture);
            // $newFeaturedPicture->setDisplayOrder(1);

            return $this->render('media/display-order.html.twig', [
                'newFeaturedPicture' => $newFeaturedPicture,
                'oldFeaturedPicture' => $oldFeaturedPicture
            ]);
        // }
    }

}