<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AddProductController extends AbstractController
{
    /**
     * @Route("/addProduct", name="add_product")
     */
    public function index()
    {
        return $this->render('add_product/login.html.twig', [
            'controller_name' => 'AddProductController',
        ]);
    }
}
