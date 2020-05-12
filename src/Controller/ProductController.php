<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    public function index()
    {
//        TODO создать объект товар передать сюда с этими полями
//        TODO возможно передавать на страницу сразу объекст товар + пользователь + комменты
        $name = "Merc";
        $img = "";
        $price = 300;
        $stars = 1;
        $about = "lalalalalalalall";
        $comments = array([]);
//        TODO создать объект юзер передать сюда
        $user = "";

        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'name' => $name,
            'about' => $about,
            'img' => $img,
            'price' => $price,
            'name' => $name,
            'about' => $about,

        ]);
    }


}
