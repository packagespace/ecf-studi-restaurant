<?php

namespace App\Controller\Admin;

use App\Entity\DayOpeningHours;
use App\Entity\Dish;
use App\Entity\DishCategory;
use App\Entity\DishPhoto;
use App\Entity\MaximumNumberOfGuests;
use App\Entity\Menu;
use App\Entity\OpeningHourRange;
use App\Entity\Reservation;
use App\Entity\SetMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(DishPhotoCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
//         return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('App');
    }

    public function configureCrud(): Crud
    {
        return Crud::new()
            ->setPageTitle('index', 'Le Quai Antique - Administration - %entity_name%')
            ->setPageTitle('detail', 'Le Quai Antique - Administration - %entity_name%')
            ->setPageTitle('new', 'Le Quai Antique - Administration - %entity_name%')
            ->setPageTitle('edit', 'Le Quai Antique - Administration - %entity_name%');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Back to the website', 'fa fa-home', 'app_homepage');
        yield MenuItem::linkToCrud('Galerie', 'fas fa-list', DishPhoto::class);
        yield MenuItem::linkToCrud('Catégories', 'fas fa-list', DishCategory::class);
        yield MenuItem::linkToCrud('Plats', 'fas fa-list', Dish::class);
        yield MenuItem::linkToCrud('Menus', 'fas fa-list', Menu::class);
        yield MenuItem::linkToCrud('Formules', 'fas fa-list', SetMenu::class);
        yield MenuItem::linkToCrud('Heures d\'ouverture', 'fas fa-list', DayOpeningHours::class);
        yield MenuItem::linkToCrud('Réservations', 'fas fa-list', Reservation::class);
        yield MenuItem::linkToCrud('Capacité maximale', 'fas fa-list', MaximumNumberOfGuests::class);
    }
}
