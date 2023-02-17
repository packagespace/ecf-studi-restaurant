<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Turbo\TurboBundle;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(Request $request): Response
    {
        $reservation = new Reservation();

        $form = $this->createForm(ReservationType::class, $reservation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (TurboBundle::STREAM_FORMAT === $request->getPreferredFormat()) {
                // If the request comes from Turbo, set the content type as text/vnd.turbo-stream.html and only send the HTML to update
                $request->setRequestFormat(TurboBundle::STREAM_FORMAT);
                return $this->render('reservation/datepicker.stream.html.twig', [
                    'reservation' => new Reservation(),
                    'form' => $form
                ]);
            }
            return $this->redirectToRoute('app_reservation');
        }

        return $this->render('reservation/index.html.twig', [
            'reservation' => $reservation,

            'form' => $form
        ]);
    }
}
