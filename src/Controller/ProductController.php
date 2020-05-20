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
     * @Route("/product/{id}", name="product")
     */
    public function index($id, ProductRepository $productRepository, Request $request)
    {
        $product = $productRepository->find($id);
        $user = $product->getUser();
        $userAut = $this->getUser();
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $comment = $form->getData();
            $comment->setUser($userAut);
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirect("/product/".$product->getId());
        }

        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'product'=>$product,
            'user'=>$user
        ]);
    }


}
