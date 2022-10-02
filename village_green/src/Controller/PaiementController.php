<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Entity\OrdersDetails;
use App\Entity\Products;
use App\Repository\CategoriesRepository;
use App\Repository\CustomersRepository;
use App\Repository\LiveRepository;
use App\Repository\OrdersDetailsRepository;
use App\Repository\OrdersRepository;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class PaiementController extends AbstractController
{
    /**
     * @Route("/paiement", name="paiement")
     */
    public function paiement(SessionInterface $session, CategoriesRepository $cat): Response
    {
        $panier = $session->get("panier", []);
        dump($panier);
        return $this->render('paiement/index.html.twig', [
            'panier' => $panier,
            'menu' => $cat->findAll(),
        ]);
    }
//    /**
//     * @route("/teste/{id}",name="testeemail")
//     */
//    public function teste(OrdersRepository $repo,$id){
//        $order= $repo->find($id);
//        return $this->render('paiement/confirmation_email.html.twig', [
//            'order' => $order,
//        ]);
//    }
    /**
     * @Route("/paiementvalider", name="OrderComplete")
     */
    public function OrderComplete(SessionInterface       $session, CustomersRepository $client, LiveRepository $habiter,
                                  EntityManagerInterface $manager, ProductsRepository $produit, MailerInterface $mailer): Response
    {


        $orders = new Orders();
        $totalht=0;

        $panier = $session->get("panier", []);
        if (empty($panier)) {
            return $this->redirectToRoute('accueil');
        }
        $profil = $client->findOneBy(['users' => $this->getUser()]);
        $live = $habiter->findAdresse($profil, 0);
        $orders->setOrderDate(new \DateTime());
        $orders->setCustomer($profil);
        $orders->setLivesBilling($live);
        $orders->setLivesDelivery($live);
        $orders->setStatus(0);
        $manager->persist($orders);


        foreach ($panier as $key => $value) {
            $orderDetail = new OrdersDetails();
            $prodid = $produit->find($key);
            $panier[$key]['prix'] = $prodid->getPrice();
            $panier[$key]['stock'] = $prodid->getStock();
            //  dd($key);
            $totalht += $panier[$key]['prix'] * $panier[$key]['qte'];
            $orderDetail->setProduct($prodid);
            $orderDetail->setQuantite($panier[$key]['qte']);
            $orderDetail->setUnitPrice($panier[$key]['prix']);
            $orderDetail->setDiscount(0);
            $orderDetail->setOrders($orders);
            $manager->persist($orderDetail);

            // $manager->clear();
        }
        $manager->flush();
        $html = $this->renderView('paiement/confirmation_email.html.twig', array(
            'order' => $orders,
            'total' => $totalht
        ));
        $text = $this->renderView('paiement/confirmation_email_text.html.twig', array(
            'order' => $orders,
            'total' => $totalht
        ));
        $session->set('panier', []);
        $email = ((new TemplatedEmail()))
            ->from('contact@lefebvreharold.fr')
            ->to($this->getUser()->getUserIdentifier())

            ->subject('Commande confirmé')
            ->text($text)
            ->html($html);

        $mailer->send($email);
        return $this->redirectToRoute('commandeTerminer');
//        return $this->render('paiement/index.html.twig', [
//            'panier' => $panier,
//            'menu' => $cat->findAll(),
//        ]);
    }

    /**
     * @Route("/commandevalider", name="commandeTerminer")
     */
    public function commandeTerminer(SessionInterface $session, CategoriesRepository $cat): Response
    {
        $panier = $session->get("panier", []);

        return $this->render('paiement/valider.html.twig', [
            'panier' => $panier,
            'menu' => $cat->findAll(),
        ]);
    }

}
