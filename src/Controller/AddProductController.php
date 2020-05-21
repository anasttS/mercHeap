<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\User;
use ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AddProductController extends AbstractController
{
    /**
     * @Route("/addProduct", name="add_product")
     */
    public function addProduct(Request $request)
    {
        $product = new Product();
        $user = $this->getUser();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $productName = $form['name']->getData();
            $productPrice = $form['cost']->getData();
            $productDescription = $form['description']->getData();

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['photo']->getData();
            if ($uploadedFile) {
                $destination = $this->getParameter('kernel.project_dir') . '/public/uploads';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename . '-' . uniqid() . '.' . $uploadedFile->guessClientExtension();
                $uploadedFile->move($destination, $newFilename);
            }

            $product->setName($productName);
            $product->setDescription($productDescription);
            $product->setCost($productPrice);
            $product->setPhoto($newFilename);
            $product->setUser($user);


            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirect("/profile");
        }


        return $this->render('add_product/login.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'AddProductController',
        ]);
    }
}
