<?php

namespace App\Controller;

use App\Entity\Products;
use App\Repository\CategoriesRepository;
use App\Repository\ProductsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\throwException;

/**
 * @Route("/produits")
 */
class ProduitsController extends AbstractController
{
    /**
     * @Route("/", name="produits")
     */
    public function produits(ProductsRepository $repo,CategoriesRepository $cat, PaginatorInterface $paginator, Request $request): Response
    {
        $produit = $paginator->paginate(
            $repo->findAll(),
            $request->query->getInt('page', 1),
            10
        );
//        dump($repo->findAll());
        return $this->render('produits/index.html.twig', [
            'produits' => $produit,
            'menu'=> $cat->findAll()
        ]);
    }

    /**
     * @Route("/listes/{id}", name="produits_listes")
     */
    public function Listes(ProductsRepository $repo,$id,CategoriesRepository $cat): Response
    {
//        dump($repo->findAll());
        $produit = $repo->findBy(['catprod'=>$id]);
        if(!$produit){
            return $this->render('error/404.html.twig', [

                'menu'=> $cat->findAll()
            ]);

        }
        return $this->render('produits/categorie.html.twig', [
            'produits' => $produit,
            'menu'=> $cat->findAll()
        ]);
    }

    /**
     * @Route("/details/{id}", name="produit_details")
     */
    public function detailslistes(Products $produits,CategoriesRepository $cat): Response
    {


        return $this->render('details/index.html.twig', [
            'details' => $produits,
            'menu'=> $cat->findAll()
        ]);
    }
}
