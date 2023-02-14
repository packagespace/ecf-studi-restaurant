<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        return $this->render('/index.html.twig', [
            'controller_name' => 'RestaurantController',
        ]);
    }

    #[Route('/login', name: 'login')]
    public function login()
    {
        return $this->render('/login.html.twig');
    }
}
