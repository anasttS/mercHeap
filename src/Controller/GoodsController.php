<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;

class GoodsController extends AbstractController
{


    /**
     * @Route("/goods", name="goods")
     */
    public function index(ProductRepository $repository, Request $request)
    {
//        $products = $repository->findAll();
        $search = $request->query->get('query');
        if ($search) {
            $products = $repository->search($search);
        } else {
            $products = $repository->findAll();
        }

        return $this->render('goods/index.html.twig', [
            'products' => $products,
            'controller_name' => 'GoodsController'
        ]);
    }

//    public function search(ProductRepository $repository, Request $request)
//    {
//        $search = $request->query->get('query');
//        if ($search) {
//            $products = $repository->search($search);
//        } else {
//            $products = $repository->findAll();
//        }
//
//        return $this->render('goods/index.html.twig', [
//            'products' => $products,
//
//            'controller_name' => 'GoodsController'
//        ]);
//    }
}
