<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ShippingController extends AbstractController
{
    /**
     * @Route("/shipping", name="shipping")
     */
    public function index()
    {
        return $this->render('shipping/index.html.twig', [
            'controller_name' => 'ShippingController',
        ]);
    }
}
