<?php

namespace App\Controller;

use App\Entity\Customers;
use App\Entity\Lives;
use App\Repository\CategoriesRepository;
use App\Repository\CustomersRepository;
use App\Repository\LiveRepository;
use App\Repository\OrdersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UsersController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils, CategoriesRepository $cat, CustomersRepository $profil): Response
    {
        if ($this->getUser()) {
            $client = $profil->findOneBy(['users' => $this->getUser()]);
            if ($client) {
                return $this->redirectToRoute('accueil');
            } else {
                $this->addFlash('verify_email_error', 'Veuillez remplir votre profil.');

                return $this->redirectToRoute('app_profil');

            }
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['menu' => $cat->findAll(), 'last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): Response
    {
        return $this->redirectToRoute('accueil');
        // throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/profil", name="app_profil")
     */
    public function profil(CustomersRepository $profil, CategoriesRepository $cat): Response
    {

        $client = $profil->findOneBy(['users' => $this->getUser()]);

        return $this->render('security/profil.html.twig', ['menu' => $cat->findAll(), 'profil' => $client]);
    }

    /**
     * @Route("/profil/post", name="profilUpdate")
     */
    public function profilInsert(CategoriesRepository $cat, Request $request, EntityManagerInterface $manger, CustomersRepository $client, LiveRepository $habiter)
    {
        if (!$client->findOneBy(['users' => $this->getUser()])) {
            $profil = new Customers();
            $live = new Lives();
        } else {
            $profil = $client->findOneBy(['users' => $this->getUser()]);

            $live = $habiter->findAdresse($profil, 0);

        }

//dd($live);
        if ($request->getMethod() == 'POST') {

            $nom = $request->get('nom');
            $prenom = $request->get('prenom');
            $adresse = $request->get('adresse');
            $cp = $request->get('cp');
            $ville = $request->get('ville');
            $pays = $request->get('pays');
            $tel = $request->get('telephone');
            $genre = $request->get('genre');
            $type = $request->get('type');
            $profil->setGender($genre);
            $profil->setType($type);
            $profil->setFirstname($prenom);
            $profil->setLastname($nom);
            $profil->setTelephone($tel);

            $live->setAddress($adresse);
            $live->setZipcode($cp);
            $live->setCity($ville);
            $live->setCountry($pays);
            $live->setType(0);


            if (!$client->findOneBy(['users' => $this->getUser()])) {
                $profil->setUsers($this->getUser());
                $live->addCustomer($profil);
                $profil->addLive($live);
                $manger->persist($profil);
                $manger->persist($live);
            }

            $manger->flush();
            return $this->redirectToRoute('app_profil');
        }


        return $this->render('security/profil.html.twig', ['menu' => $cat->findAll()]);

    }

    /**
     * @Route("/profil/mescommandes", name="mescommandes")
     */
    public function mescommandes(CategoriesRepository $cat, OrdersRepository $repo, CustomersRepository $user): Response
    {

        return $this->render('security/mescommandes.html.twig', [
                'menu' => $cat->findAll(),
                'commandes' => $repo->findBy(['customer' => $user->findOneBy(['users' => $this->getUser()])])
            ]
        );
    }
}
