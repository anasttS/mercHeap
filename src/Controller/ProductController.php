<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Product;
use App\Entity\User;
use App\Repository\ProductRepository;
use CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    public function index(ProductRepository $productRepository, Request $request)
    {
        $product = $productRepository->find(1);
        $user = $product->getUser();
        $userAut = $this->getUser();
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $comment = $form->getData();
            $comment->setUser($userAut);
            $comment->setTime(date('Y-m-d H:i:s'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirect("/product/".$product->getId());
        }

        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'product'=>$product,
            'user'=>$user,
            'form'=>$form
        ]);
    }


}
