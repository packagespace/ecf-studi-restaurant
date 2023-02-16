<?php

namespace App\Controller;

use App\Repository\DishPhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(DishPhotoRepository $dishPhotoRepository): Response
    {
        $dishPhotos = $dishPhotoRepository->findAll();

        return $this->render('/index.html.twig', [
            'dish_photos' => $dishPhotos,
            'controller_name' => 'RestaurantController',
        ]);
    }
}
