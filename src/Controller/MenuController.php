<?php

namespace App\Controller;

use App\Repository\DishCategoryRepository;
use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menu', name: 'app_menu')]
    public function index(DishCategoryRepository $dishCategoryRepository, MenuRepository $menuRepository): Response
    {
        $dishCategories = $dishCategoryRepository->findAll();
        $menus = $menuRepository->findAll();
        return $this->render('menu/index.html.twig', [
            'dish_categories' => $dishCategories,
            'menus' => $menus
        ]);
    }
}
