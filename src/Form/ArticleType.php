<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title',
                TextType::class,
                [
                    'label' => 'Titre'
                ]
            )
            ->add(
                'content',
                TextareaType::class,
                [
                    'label' => 'Contenu'
                ]
            )   
             ->add(
                'description',
                TextareaType::class,
                [
                    'label' => 'Description'
                ]
            )                  
             ->add(
                'category',
                //<select>     
                EntityType::class,
                [
                    'label' => 'Catégorie',
                    'class' => Category::class,
                    //nom du champ qui s'affiche ds les options
                    'choice_label' => 'name',
                    //1ère option vide
                    'placeholder' => 'Choisissez une catégorie'
                ]
            )                   
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
            'data_class' => Article::class,
        ]);
    }
}
