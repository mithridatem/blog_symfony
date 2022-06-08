<?php

namespace App\Controller\Admin;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class DashboardController extends AbstractDashboardController
{
    //constructeur pour la génération des URLs CRUDs
    public function __construct(private AdminUrlGenerator $adminUrlGenerator){}
    
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
        ->setController(ArticleCrudController::class)
        ->generateUrl();
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Blog');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Retour à l\'accueil', 'fa fa-home', 'app_accueil');
        yield MenuItem::linkToCrud('Articles', 'fas fa-list', Article::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-newspaper', Category::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-users', User::class);
    }
}
//contenu de d'origine de la méthode index
//return parent::index();

// Option 1. You can make your dashboard redirect to some common page of your backend
//
// $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
// return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

// Option 2. You can make your dashboard redirect to different pages depending on the user
//
// if ('jane' === $this->getUser()->getUsername()) {
//     return $this->redirect('...');
// }

// Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
// (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
//
// return $this->render('some/path/my-dashboard.html.twig');