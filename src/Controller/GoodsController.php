<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GoodsController extends AbstractController
{
    /**
     * @Route("/goods", name="goods")
     */
    public function index()
    {
        return $this->render('goods/index.html.twig', [
            'controller_name' => 'GoodsController',
        ]);
    }
}
