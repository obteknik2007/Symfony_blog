<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categ")
 * 
 */
class CategoryController extends Controller
{
    public function menu()
    {
         $repository = $this->getDoctrine()->getRepository(Category::class);
        
        //on recup ttes les catégories
        $categories = $repository->findAll();
        
        return $this->render('category/menu.html.twig', [
           'categories' => $categories
        ]);
    }
            
    /**
     * @Route("/{id}")
     */
    public function index(/*$id*/Category $category)
    {
        /*
       $repository = $this->getDoctrine()->getRepository(Category::class);
       $category = $repository->find($id);
       */
        
        $repository = $this->getDoctrine()->getRepository(Article::class);
        //$articles = $repository->findBy(['category' => $category]);
        //avec utilisation de findLatest()
        $articles = $repository->findLatest(2,$category);
        
        return $this->render(
            'category/index.html.twig',
            [
                'category' => $category,
                'articles' => $articles
            ]
        );
    }
}
