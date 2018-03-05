<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                    'lastname',
                    TextType::class,
                    [
                        'label' => 'Nom'
                    ]
                )
                ->add(
                    'firstname',
                    TextType::class,
                    [
                        'label' => 'Prénom'
                    ]
                )
                ->add(
                    'email',
                     EmailType::class,
                    [
                        'label' => 'Email'
                    ]
                )
                //le mdp en clair que l'on ne va pas stocker en bdd
                ->add(
                     'plainPassword',
                        //2 champs qui doivent etre identiques
                     RepeatedType::class,
                    [
                        //... de type password
                        'type' => PasswordType::class,
                        'first_options' => [
                            'label' => 'Mot de passe'
                        ],
                        'second_options' => [
                            'label' => 'Confirmation du mot de passe'
                        ]
                    ]
                )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
