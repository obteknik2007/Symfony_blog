<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


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
    
    /**
     * 
     * @Route("/login") 
     */
    public function login(AuthenticationUtils $authenticationUtils){
        
        //2 méthodes utilisées de la classe $authenticationUtils
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        
        //on passe $error et $lastUsername à la vue
        return $this->render('security/login.html.twig', 
            [
                'error' => $error,
                'last_username' => $lastUsername
            ]
        );        
    }
    
    /**
     * @Route("/logout")
     */
    public function logout(){
        
    }
    
}
