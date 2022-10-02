<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function search(ProductsRepository $repo,CategoriesRepository $cat, Request $request): Response
    {
        $name = $request->get('q');
     //   dump($name);
     //   dump($repo->findBySearch($name));
        return $this->render('search/index.html.twig', [
            'menu'=> $cat->findAll(),
            'produits' => $repo->findBySearch($name)
        ]);
    }
}
