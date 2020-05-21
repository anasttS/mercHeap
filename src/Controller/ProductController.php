<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Product;
use App\Entity\User;
use App\Repository\ProductRepository;
use CommentType;
use DateTime;
use phpDocumentor\Reflection\Types\Integer;
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
        $id = $request->request->get('id');
        $product = $productRepository->find($id);
        $user = $product->getUser();
        $userAut = $this->getUser();
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
//        dd($product);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->setUser($userAut);
            $comment->setProduct($product);
            $d = new DateTime();
            $d->format('Y-m-d H:i:s');
            $comment->setTime($d);
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            $this->redirectToRoute('product', ['id' => $id], 302);
        }

        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'product' => $product,
            'user' => $user,
            'form' => $form->createView()
        ]);
    }


}
