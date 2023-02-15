<?php

namespace App\Controller;

use App\Entity\DishPhoto;
use App\Form\DishPhotoFormType;
use App\Repository\DishPhotoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
//    #[Route('/admin', name: 'app_admin')]
//    public function index(): Response
//    {
//        return $this->render('admin/index.html.twig', [
//            'controller_name' => 'AdminController',
//        ]);
//    }

    #[Route('/admin/dish-photos', name: 'dish_photos')]
    public function uploadDishPhoto(Request $request, EntityManagerInterface $entityManager, DishPhotoRepository $dishPhotoRepository): RedirectResponse|Response
    {
        $dishPhotos = $dishPhotoRepository->findAll();

        $dishPhoto = new DishPhoto();

        $form = $this->createForm(DishPhotoFormType::class, $dishPhoto);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($dishPhoto);
            $entityManager->flush();

            return $this->redirectToRoute('dish_photos');
        }

        return $this->render('admin/dish-photos.html.twig', [
            'form' => $form,
            'dish_photos' => $dishPhotos
        ]);
    }
}
