<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Repository\CustomersRepository;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class FactureController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/facture/pdf/{order}", name="facturePdf")
     */

    public function facturePdf(Pdf $knpSnappyPdf, Orders $order)
    {
        if ($order->getCustomer()->getUsers() !== $this->getUser()) {
            return $this->redirectToRoute('accueil');
        }
        $html = $this->renderView('facture/index.html.twig', array(
            'order' => $order
        ));
        return new PdfResponse(
            $knpSnappyPdf->getOutputFromHtml($html),
            'facture_numero_'. $order->getId().'.pdf'
        );
    }
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/facture/pdfadmin/{order}", name="facturePdfadmin")
     */

    public function factureAdminPdf(Pdf $knpSnappyPdf, Orders $order)
    {

        $html = $this->renderView('facture/index.html.twig', array(
            'order' => $order
        ));
        return new PdfResponse(
            $knpSnappyPdf->getOutputFromHtml($html),
            'facture_numero_'. $order->getId().'.pdf'
        );
    }

    /**
     * @isGranted("ROLE_USER")
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
