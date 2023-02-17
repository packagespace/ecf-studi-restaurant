<?php

namespace App\Controller;

use App\OpeningHours\OpeningHoursCompiler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OpeningHoursController extends AbstractController
{
    #[Route('/opening/hours', name: 'app_opening_hours')]
    public function index(OpeningHoursCompiler $openingHoursCompiler): Response
    {
        $openingHours = $openingHoursCompiler->getOpeningHours();
        return $this->render('opening_hours/_opening_hours.html.twig', [
            'opening_hours' => $openingHours,
        ]);
    }
}
