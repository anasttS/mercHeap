<?php

namespace App\Controller;

use App\Entity\OrderUser;
use App\Entity\Product;
use App\Entity\ShopList;
use App\Entity\User;
use App\Repository\ProductRepository;
use OrderType;
use PhpParser\Node\Expr\List_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use UserType;

class ShippingController extends AbstractController
{


    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    private $array;

    /**
     * @Route("/shipping", name="order")
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createOrder(Request $request)
    {

//        $array = array(
//            '1' => 1,
//            '4' => 2,
//            '5' => 3
//        );
//
//
//        $em = $this->getDoctrine()->getManager();
//        $json = json_encode($array);
//        $array = json_decode("localStorage.getItem('cart')");
//if($_POST['param']) {
//    $array = json_decode($_POST['param']);
//    exit();
//} else{
//    $array = array();
//}
//
//        $array = json_decode($json);

//        if ($_POST['search']) {
//            $json = $_POST['search'];
//            $array = json_decode($json);
//        } else {
//            $array =array();
//        }
//        dd($array);

        $order = new OrderUser();
        $user = $this->getUser();

        $products = array();
        $price = 0;
        $taxes = 13;
        $this->getJson();
        foreach ($this->array as $k => $v) {
            $product = $this->productRepository->find($k);
            $shopList = new ShopList();
            $shopList->setProduct($product);
            $shopList->setCount($v);
            $shopList->setOrderId($order);
            $price = $price + $product->getCost() * $v;\
            array_push($products, $shopList);
        }
        $order->setPrice($price);
        $subtotal = $price + $taxes;
        $order->setSubtotal($subtotal);


        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);
//            dd($order);
        if ($form->isSubmitted()) {

            $order = $form->getData();
            $order->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($order);
            $em->flush();
            dd($order);
            foreach ($this->array as $k => $v) {
                $product = $this->productRepository->find($k);
                $shopList = new ShopList();
                $shopList->setProduct($product);
                $shopList->setCount($v);
                $shopList->setOrderId($order);
                $em->persist($shopList);
            }

            $em->flush();
            return $this->redirect("profile");
        }

        return $this->render('shipping/index.html.twig', [
            'form' => $form->createView(),
            'products' => $products,
            'subtotal' => $price,
            'total' => $subtotal,
            'taxes' => $taxes
        ]);
    }

    function getJson()
    {
        if ($_POST['search']) {
            $json = $_POST['search'];
            $array = json_decode($json);
        } else {
            $array = array();
        }
        $this->array = $array;
    }
}
