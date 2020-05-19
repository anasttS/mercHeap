<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GoodsController extends AbstractController
{


    /**
     * @Route("/goods", name="goods")
     */
    public function index(ProductRepository $repository)
    {
        $products = $repository->findAll();

        return $this->render('goods/index.html.twig', [
            'products' => $products,
            'controller_name' => 'GoodsController'
        ]);
    }
}
