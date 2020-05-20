<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\User;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/{id}", name="product")
     */
    public function index($id, ProductRepository $productRepository)
    {
        $product = $productRepository->find($id);
        $user = $product->getUser();

        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'product'=>$product,
            'user'=>$user
        ]);
    }


}
