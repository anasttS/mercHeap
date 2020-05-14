<?php

namespace App\Controller;

use App\Services\ProfileService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function profile(ProfileService $service)
    {
//        TODO достать данные из бд
        $username = "Merc";
        $about = "lalalalalalalall";
        $merch = array([]);
        $my_orders = array([]);
        $links = array([]);

        $service->some();

        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'name' => $username,
            'about' => $about,
            'merch' => $merch,
            'my_orders' => $my_orders,
            'links' => $links
        ]);
    }
}
