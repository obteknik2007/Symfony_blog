<?php

namespace App\Controller\Admin;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/category")
 * Toutes les routes vont être pré&fixées par /admin du fait de l'inscription
 * 'admin' dans le fichier annotations.yaml
 */
class CategoryController extends Controller
{
    /**
     * @Route("/") //ttes méthodes vont alors être dans Admin/category/
     */
    public function index()
    {
        return $this->render('admin/category/index.html.twig', [
           
        ]);
    }
}
