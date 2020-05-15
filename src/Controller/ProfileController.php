<?php

namespace App\Controller;

use App\Services\ProfileService;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
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
        $logger->debug('Checking account page for '.$this->getUser()->getEmail());
        $username = $this->getUser()->getName();
        $about = $this->getUser()->getAbout();
        $merch = array([]);
        $my_orders = array([]);
        $links = array([]);

        return $this->render('profile/profile.html.twig', [
            'controller_name' => 'ProfileController',
            'name' => $username,
            'about' => $about,
            'merch' => $merch,
            'my_orders' => $my_orders,
            'links' => $links
        ]);
//        dd($this->getUser()->getUsername());
    }
}
