<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

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
        $repository = $this->getDoctrine()->getRepository(Category::class);
        
        //on recup ttes les catégories
        $categories = $repository->findAll();
        
        return $this->render('admin/category/index.html.twig', [
           'categories' => $categories
        ]);
    }
    
    /**
     * @Route("/edit")
     */
    public function edit()
    {
        
    }
}
