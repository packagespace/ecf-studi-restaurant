<?php

namespace App\Controller;

use App\OpeningHours\OpeningHoursCompiler;
use App\Repository\DayOpeningHoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OpeningHoursController extends AbstractController
{
    #[Route('/opening/hours', name: 'app_opening_hours')]
    public function index(DayOpeningHoursRepository $repository): Response
    {
        $dayOpeningHours = $repository->findAllInOrder();
        return $this->render('_opening_hours.html.twig', [
            'day_opening_hours' => $dayOpeningHours,
        ]);
    }
}
