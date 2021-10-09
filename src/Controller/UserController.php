<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserAccountType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class UserController extends AbstractController
{
    /**
     * @Route("/user/{id}", name="user_account")
     * @IsGranted("ROLE_USER")
     */
    public function add_avatar(Request $request, FileUploader $fileUploader, EntityManagerInterface $em, SessionInterface $session): Response
    {

        /** @var  \App\Entity\User $user*/
        $user = $this->getUser();

        $form = $this->createForm(UserAccountType::class, $user);

        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            /** @var UploadedFile $avatarFile*/
            $avatarFile = $form->get('avatarImg')->getData();

            if ($avatarFile) {
                $avatarFileName = $fileUploader->upload($avatarFile);
                $user->setAvatarImg($avatarFileName);
            }

            $em->flush();

            /** @var FlashBag */
            $flashBag = $session->getBag('flashes');

            $flashBag->add('success', "Votre avatar de profil a été mis à jour !");
            

            return $this->redirectToRoute('user_account', [
                'id' => $user->getId()
            ]);
        }

        return $this->render('user/account.html.twig',[
            'form' => $form->createView(),
            'user' => $user
        ]);
    }
}
