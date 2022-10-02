<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="accueil")
     */
    public function index(CategoriesRepository $cat): Response
    {
        $categories = $cat->findAll();
//        $final = [];
      //  var_dump($categories);
//        foreach($categories as $item)
//        {
//            $key = key($item);
//            $final[$key][] = $item[$key];
//        }
//dump($categories);
        return $this->render('home/index.html.twig', [
            'home' => $categories,
            'menu' => $categories,
        ]);
    }
}
