<?php

namespace App\Controller;

use App\Entity\User;
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
    public function profile(LoggerInterface $logger)
    {
        $logger->debug('Checking account page for ' . $this->getUser()->getEmail());
        $username = $this->getUser()->getName();
        $about = $this->getUser()->getAbout();
        $merch = $this->getUser()->getProducts();
        $my_orders = $this->getUser()->getOrders();
        $links = $this->getUser()->getLinks();
        $count = ceil(count($merch) / 3);

        return $this->render('profile/profile.html.twig', [
            'controller_name' => 'ProfileController',
            'name' => $username,
            'about' => $about,
            'merch' => $merch,
            'my_orders' => $my_orders,
            'links' => $links,
            'count' => $count
        ]);
//        dd($this->getUser()->getUsername());
    }

    /**
     * @Route("/profile", name="change")
     */
    public function change(User $user, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(UserChangeType::class);
        return $this->render('profile/profile.html.twig', [
            'profileForm'=> $form->createView()
        ]);
    }

    /**
     * @Route("/profile/addImage", name="upload_image")
     */
    public function addPhoto(Request $request)
    {
        $uploadedFile = $request->files->get('image');
        $destination = $this->getParameter('kernel.project_dir') . '/public/uploads';
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = $originalFilename . '-' . uniqid() . '.' . $uploadedFile->guessClientExtension();
        dd($uploadedFile->move($destination,
            $newFilename
        ));
    }
}
