<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }


    /**
     * @Route("/cart", name="cart")
     */
    public function index()
    {
        if ($_POST['search']) {
            $json = $_POST['search'];
            $array = json_decode($json);
        } else {
            $array = array();
        }
        $products = array();
        foreach ($array as $k => $v) {
            $product = $this->productRepository->find($k);
            array_push($products, $product);
        }

        return $this->render('cart/index.html.twig', [
            'products' => $products,
            'controller_name' => 'CartController'
        ]);
    }
}
