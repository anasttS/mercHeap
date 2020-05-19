<?php

namespace App\Controller;

use App\Entity\OrderUser;
use App\Entity\Product;
use App\Entity\ShopList;
use App\Entity\User;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use OrderType;
use PhpParser\Node\Expr\List_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use UserType;

class ShippingController extends AbstractController
{
//    /**
//     * @Route("/shipping", name="shipping")
//     */
//    public function index()
//    {
////        $em = $this->getDoctrine()->getManager();
////        $orders = $em->getRepository(Order::class)->findAll();
//        return $this->render('shipping/index.html.twig', [
//            'controller_name' => 'ShippingController',
//        ]);
//    }

        private ProductRepository $productRepository ;

        public function __construct(ProductRepository $productRepository)
        {
            $this->productRepository = $productRepository;
        }


    /**
     * @Route("/to_order", name="order")
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createOrder(Request $request)
    {

        $array = array(
            '1' => 1
//            '2' => 2,
//            '3' => 3
        );
        $json = json_encode($array);
        $array = json_decode($json);
        $order = new OrderUser();
        $user = $this->getUser();
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
//            $order = $form->getData();
            $order->setUser($user);
//            $order->setPrice(0);
//            $order->setSubtotal(0);
            $em->persist($order);
//            dd($order);
            $em->flush();

            foreach ($array as $k => $v){
//                $product = $em->getRepository(Product::class)->find((int)$k);
                $product = $this->productRepository->find($k);
                $shopList = new ShopList();
                $shopList->setProduct($product);
                $shopList->setCount($v);
                $shopList->setOrderId($order);
                $em->persist($shopList);
//                $order->addShopList($shopList);
            }
            $em->flush();
            dd($order);
//        нужно по одному добавлять в лист шоплисты
//            $order->addShopLists();
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($order);
//            $em->flush();

            return $this->redirect("profile");
        }
        return $this->render('shipping/index.html.twig',
            array('form' => $form->createView()));
    }
}
