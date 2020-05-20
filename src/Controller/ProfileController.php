<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use UserChangeType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @IsGranted("ROLE_USER")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function profile(LoggerInterface $logger, Request $request, EntityManagerInterface $em)
    {
        $logger->debug('Checking account page for ' . $this->getUser()->getEmail());
        $username = $this->getUser()->getName();
        $about = $this->getUser()->getAbout();
        $merch = $this->getUser()->getProducts();
        $my_orders = $this->getUser()->getOrders();
        $links = $this->getUser()->getLinks();
        $photo = $this->getUser()->getPhoto();

        $user = $this->getUser();
        $form = $this->createForm(UserChangeType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['photoPath']->getData();
            if ($uploadedFile) {
                $destination = $this->getParameter('kernel.project_dir') . '/public/uploads';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename . '-' . uniqid() . '.' . $uploadedFile->guessClientExtension();
                $uploadedFile->move($destination, $newFilename);
            }
            $user->setPhoto($newFilename);
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('profile');
        }
        return $this->render('profile/profile.html.twig', [
            'controller_name' => 'ProfileController',
            'profileForm' => $form->createView(),
            'name' => $username,
            'about' => $about,
            'merch' => $merch,
            'my_orders' => $my_orders,
            'links' => $links,
            'photo' => $photo,
        ]);

    }

//    /**
//     * @Route("/profile", name="change")
//     */
//    public function change(User $user, Request $request, EntityManagerInterface $em)
//    {
//        $form = $this->createForm(UserChangeType::class);
//        return $this->render('profile/profile.html.twig', [
//            'profileForm'=> $form->createView()
//        ]);
//    }


}
