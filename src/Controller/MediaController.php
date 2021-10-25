<?php

namespace App\Controller;

use App\Repository\MediaRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    public function change_display_order(MediaRepository $mediaRepository, EntityManagerInterface $em, $id =0)
    {

            $newFeaturedPicture = $mediaRepository->findById($id);

            $oldFeaturedPicture = $mediaRepository->findBy([
                'trick' => $newFeaturedPicture[0]->getTrick(),
                'displayOrder'=> 1
            ]);


            $displayOrder = $newFeaturedPicture[0]->getDisplayOrder();

            $newFeaturedPicture[0]->setDisplayOrder(1);

            
             $oldFeaturedPicture[0]->setDisplayOrder($displayOrder);

             $em->persist($newFeaturedPicture[0]);
             $em->persist($oldFeaturedPicture[0]);
             $em->flush();


            return $this->render('media/display-order.html.twig', []);
    }

}