<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SecurityController extends Controller
{
    /**
     * @Route("/inscription")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        
        $form->handleRequest($request);
        if($form->isSubmitted()){
            if($form->isValid()){
                $password = $passwordEncoder->encodePassword(
                        $user, 
                        $user->getPlainPassword()
                );
                
                $user->setPassword($password);
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                
                //message utilisateur,puis redirection vers accueil
                $this->addFlash('success', 'Votre compte est créé');
                return $this->redirectToRoute('app_index_index');
                
            } else {
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }
            
        return $this->render('security/register.html.twig', 
            [
                'form' => $form->createView()
            ]
        );
    }
}
