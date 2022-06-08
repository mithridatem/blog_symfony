<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(CategoryRepository $catRepo): Response
    {   
        $category = $catRepo->findAll();
        return $this->render('category/index.html.twig', [
            'category' => $category,
        ]);
    }
    #[Route('/showcategory/{id}', name: 'app_show_category')]
    public function getCatDetail(CategoryRepository $catRepo, int $id): Response
    {   
        $categorie = $catRepo->find($id);
        return $this->render('showCat/index.html.twig', [
            'categorie' => $categorie,
        ]);
    }


}
