<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProductController extends AbstractController
{
   
    #[Route('/', name: 'homepage')]
        public function homepage(): Response {
            return $this->render('base.html.twig');
        }

    #[Route('/product/', name: 'product')]
        public function product(ManagerRegistry $doctrine): Response {
            
            $products = $doctrine->getRepository(Product::class)->findAll();
            
            if (!$products) {
                throw $this->createNotFoundException(
                    'Erreur'
                );
            }

            return $this->render('product/index.html.twig', ['products' => $products]);
        }


    #[Route('/product/ajout', name: 'form_product')]
        public function form_product(ManagerRegistry $doctrine): Response {
            return $this->render('product/ajout.html.twig');
        }

    #[Route('/new_product', name: 'create_product')]
        public function createProduct(ManagerRegistry $doctrine, ValidatorInterface $validator): Response
        {
            $entityManager = $doctrine->getManager();
    
            $product = new Product();
            $product->setName($_POST['nom']);
            $product->setPrice($_POST['price']);
            $product->setDescription($_POST['desc']);
    
            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $entityManager->persist($product);
    
            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();
    
            $errors = $validator->validate($product);
            if (count($errors) > 0) {
                return new Response((string) $errors, 400);
            }
            
            $mess = 'Ajout du produit de nom : '.$product->getName();
    
            return $this->render('product/ajout.html.twig', ['mess' => $mess]);

        }

    #[Route('/delete_product', name: 'delete_product')]
        public function deleteProduct(ManagerRegistry $doctrine, ValidatorInterface $validator): Response
        {
            $entityManager = $doctrine->getManager();
            $product = $doctrine->getRepository(Product::class)->findOneBy(['id' => $_POST['delete']]);
            
            if (!$product) {
                throw $this->createNotFoundException('No guest found for id '.$_POST['delete']);
            }
            $entityManager->remove($product);
            $entityManager->flush();
            
            $products = $doctrine->getRepository(Product::class)->findAll();
            
            if (!$products) {
                throw $this->createNotFoundException(
                    'No product found for id'
                );
            }


            $mess = 'Suppression du produit de nom : '.$product->getName();

            return $this->render('product/index.html.twig', ['products' => $products, 'mess' => $mess]);
        }



    #[Route('/product/{id}', name: 'product_show')]
        public function show(ManagerRegistry $doctrine, int $id): Response
        {
            $product = $doctrine->getRepository(Product::class)->find($id);

            if (!$product) {
                throw $this->createNotFoundException(
                    'No product found for id '.$id
                );
            }

            return new Response('Check out this great product: '.$product->getName());

            // or render a template
            // in the template, print things with {{ product.name }}
            // return $this->render('product/show.html.twig', ['product' => $product]);
        }
    }