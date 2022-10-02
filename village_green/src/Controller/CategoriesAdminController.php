<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\CategoriesType;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/categories")
 */
class CategoriesAdminController extends AbstractController
{
    /**
     * @Route("/", name="categories_admin_index", methods={"GET"})
     */
    public function index(CategoriesRepository $categoriesRepository): Response
    {
        return $this->render('admin/categories/index.html.twig', [
            'categories' => $categoriesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="categories_admin_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $category = new Categories();
        $form = $this->createForm(CategoriesType::class, $category);
        $form->handleRequest($request);
    //    dd($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $objfichier = $request->files->get('categories');
            $aMimeTypes = array("image/gif", "image/jpeg", "image/jpg", "image/png", "image/x-png", "image/tiff");

            $fichier = $objfichier['picture'];
            if (!empty($fichier)&& in_array($fichier->getClientmimeType(), $aMimeTypes)) {
                if ($fichier->move('assets/src/', $fichier->getClientOriginalName())) {
                    $category->setPicture($fichier->getClientOriginalName());
                    $entityManager->persist($category);
                    $entityManager->flush();
                }

            }


            return $this->redirectToRoute('categories_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/categories/new.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="categories_admin_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Categories $category, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoriesType::class, $category);
        $form->handleRequest($request);
        $category->setPicture($category->getPicture());

        if ($form->isSubmitted() && $form->isValid()) {
            $aMimeTypes = array("image/gif", "image/jpeg", "image/jpg", "image/png", "image/x-png", "image/tiff");
            //   $img = ['products']['photo'];
            $objfichier = $request->files->get('categories');

            $fichier = $objfichier['picture'];
            if (!empty($fichier)&& in_array($fichier->getClientmimeType(), $aMimeTypes)) {
                if ($fichier->move('assets/src/', $fichier->getClientOriginalName())) {
                    $category->setPicture($fichier->getClientOriginalName());
                }

            }
            $entityManager->flush();

            return $this->redirectToRoute('categories_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/categories/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="categories_admin_show", methods={"GET"})
     */
    public function show(Categories $category): Response
    {
        return $this->render('admin/categories/show.html.twig', [
            'category' => $category,
        ]);
    }


    /**
     * @Route("/{id}", name="categories_admin_delete", methods={"POST"})
     */
    public function delete(Request $request, Categories $category, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $category->getId(), $request->request->get('_token'))) {
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categories_admin_index', [], Response::HTTP_SEE_OTHER);
    }
}
