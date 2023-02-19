<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\User;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{

    #[Route('/reservation', name: 'app_reservation')]
    public function index(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        /** @var ?User $user */
        $user = $security->getUser();
        $reservation = new Reservation();
        if ($user) {
            $reservation->setAllergies($user->getAllergies());
            if ($user->getDefaultNumberOfGuests() !== null) {
                $reservation->setNumberOfGuests($user->getDefaultNumberOfGuests());
            }

        }

        $form = $this->createForm(ReservationType::class, $reservation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservation);
            $entityManager->flush();
            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('reservation/index.html.twig', [
            'reservation' => $reservation,
            'form'        => $form
        ]);
    }
}
