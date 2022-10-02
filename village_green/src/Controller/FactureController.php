<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Repository\CustomersRepository;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class FactureController extends AbstractController
{
    /**
     * @Route("/facture/pdf/{order}", name="facturePdf")
     */

    public function facturePdf(Pdf $knpSnappyPdf, Orders $order, CustomersRepository $cust)
    {
        if ($order->getCustomer() !== $cust->findOneBy(['users' => $this->getUser()]) and $this->getUser()->getRoles() == "ROLE_USER") {
            return $this->redirectToRoute('accueil');
        }
        $html = $this->renderView('facture/index.html.twig', array(
            'order' => $order
        ));
        return new PdfResponse(
            $knpSnappyPdf->getOutputFromHtml($html),
            'facture-numero-' . $order->getId() . '.pdf'
        );
    }

    /**
     * @Route("/facture/vu/{order}", name="facture")
     */

    public function facture(Orders $order, CustomersRepository $cust): Response
    {
        if ($order->getCustomer() !== $cust->findOneBy(['users' => $this->getUser()]) and !in_array("ROLE_ADMIN", $this->getUser()->getRoles())) {

            return $this->redirectToRoute('accueil');
        }
        return $this->render('facture/index.html.twig', [
                'order' => $order
            ]
        );
    }

}
