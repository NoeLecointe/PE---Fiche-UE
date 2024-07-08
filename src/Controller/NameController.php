<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NameController extends AbstractController
{
    #[Route('/name', name: 'app_name')]
    public function index(): Response
    {
        return $this->render('name/index.html.twig', [
            'controller_name' => 'NameController',
        ]);
    }
}
