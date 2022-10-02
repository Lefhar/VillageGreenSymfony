<?php

namespace App\Controller;

use App\Entity\Products;
use App\Repository\CategoriesRepository;
use App\Repository\CustomersRepository;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PaniersController extends AbstractController
{
    /**
     * @Route("/paniers/add", name="paniers_add")
     */
    public function panierAdd(SessionInterface $session,ProductsRepository $prod, Request $request): Response
    {
        $panier = $session->get("panier", []);


        if ($request->getMethod() == 'POST') {
            $produit = $prod->find($request->get('produit'));
            $panier[$request->get('produit')] = [
                "name" => $request->get('name'),
                "photo" => $request->get('photo'),
                "qte" => $request->get('qte'),
                "stock" => $produit->getStock(),
                "prix" => $produit->getPrice()
            ];
            $session->set("panier", $panier);
        }
       // dump($panier);
   //     return $this->json($panier,201,[]);
        $referer = $request->headers->get('referer');
        return new RedirectResponse($referer);
    }

    /**
     * @Route("/paniers/add/json", name="panierAddJson")
     */
    public function panierAddJson(SessionInterface $session,ProductsRepository $prod, Request $request): Response
    {
        $panier = $session->get("panier", []);


        if ($request->getMethod() == 'POST') {
            $produit = $prod->find($request->get('produit'));
            $panier[$request->get('produit')] = [
                "name" => $request->get('name'),
                "photo" => $request->get('photo'),
                "qte" => $request->get('qte'),
                "stock" => $produit->getStock(),
                "prix" => $produit->getPrice()
            ];
            $session->set("panier", $panier);
        }
       // dump($panier);
        return $this->json($panier,201,[]);
//        $referer = $request->headers->get('referer');
//        return new RedirectResponse($referer);
    }

    /**
     * @Route("/paniers/update", name="paniers_update")
     */
    public function panierUpdate(SessionInterface $session,ProductsRepository $prod, Request $request): Response
    {
        $panier = $session->get("panier", []);
        if ($request->getMethod() == 'POST') {
            $produit = $prod->find($request->get('id'));
            $id = $request->get('id');
            if($request->get('qte')<=0){
                unset($panier[$id]);
            }else{
                if($request->get('qte')<= $produit->getStock()) {
                    $panier[$id]["qte"]=$request->get('qte');
                }

            }


            $session->set("panier", $panier);
        }
        $referer = $request->headers->get('referer');
      return new RedirectResponse($referer);
//        return $this->render('paniers/index.html.twig', [
//
//            'menu'=> $cat->findAll()
//        ]);
    }

   /**
     * @Route("/paniers/update/json", name="paniers_update_json")
     */
    public function panierUpdateJson(SessionInterface $session,ProductsRepository $prod, Request $request): Response
    {
        $panier = $session->get("panier", []);
        if ($request->getMethod() == 'POST') {
            $produit = $prod->find($request->get('id'));
            $id = $request->get('id');
            if($request->get('qte')<=0){
                unset($panier[$id]);
            }else{
                if($request->get('qte')<= $produit->getStock()) {
                    $panier[$id]["qte"]=$request->get('qte');
                }

            }


            $session->set("panier", $panier);
        }
        return $this->json($panier,201,[]);
    }

    /**
     * @Route("/paniers/", name="paniers")
     */
    public function panier(SessionInterface $session, ProductsRepository $prod, CategoriesRepository $cat, CustomersRepository $client): Response
    {

        $panier = $session->get("panier", []);
        if(!empty($panier)){


        foreach ($panier as $key => $row) {
            $produit = $prod->find($key);

            $panier[$key]['prix'] = $produit->getPrice();
            $panier[$key]['stock'] = $produit->getStock();
            // $panier[$key]['total'] = $produit->getPrice()* $panier[$key]["qte"];
        }
        }
//var_dump($panier);
        return $this->render('paniers/index.html.twig', [
            'panier' => $panier,
            'menu' => $cat->findAll(),

        ]);
    }

    /**
     * @Route("/paniers/livraison", name="livraison")
     */
    public function Livraison(SessionInterface $session, CategoriesRepository $cat, CustomersRepository $client): Response
    {
        $profil = $client->findOneBy(['users'=>$this->getUser()]);
        $panier = $session->get("panier");
        if(empty($panier)or !$profil)
        {
            return $this->redirectToRoute('paniers');
          //  $information = $profil;
        }
//var_dump($panier);
        return $this->render('paniers/livraison.html.twig', [
            'panier' => $panier,
            'menu' => $cat->findAll(),
            'profil'=>$profil
        ]);
    }
 /**
     * @Route("/paniers/livraison/validation", name="validation")
     */
    public function validation(SessionInterface $session, CategoriesRepository $cat, CustomersRepository $client): Response
    {
        $profil = $client->findOneBy(['users' => $this->getUser()]);
        $panier = $session->get("panier");
        if (!empty($panier) or !$profil) {
            $panier = $session->get('panier');


            //
            //  $information = $profil;
            $session->set('panier', $panier);
            dump($panier);
            return $this->redirectToRoute('paiement');

        } else {
            return $this->redirectToRoute('accueil');
        }

    }


}
