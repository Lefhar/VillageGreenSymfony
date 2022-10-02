<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{
    /**
     * @Route("/categories/{id}", name="categories")
     */
    public function index(CategoriesRepository $cat, $id): Response
    {
        $categories = $cat->findAll();
        if (!$cat->findBy(['souscat' => $id])) {
            return $this->render('error/404.html.twig', [

                'menu' => $categories
            ]);
        }
        return $this->render('categories/index.html.twig', [
            'categories' => $cat->findBy(['souscat' => $id]),
            'menu' => $categories,
        ]);
    }
}
