<?php

namespace App\Entity;

//use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="Cet email est déjà utilisé")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column()
     * @Assert\NotBlank(message="Ce champ ne peut être vide")
     * @var string
     */
    private $lastname;
    
     /**
     * @ORM\Column()
     * @Assert\NotBlank()
     * @var string
     */
    private $firstname;
    
     /**
     * @ORM\Column(unique=true)
     * @Assert\NotBlank()
     * @Assert\Email(message="Cet email n'est pas valide")
     * @var string
     */
    private $email;
        
     /**
     * @ORM\Column()
     * @var string
     */
    private $password;
            
     /**
     * @ORM\Column(length=20)
     * @var string
     */
    private $role = 'ROLE_USER';
         
     /**
     * @Assert\NotBlank()
     * @var string
     */
    private $plainPassword;  
    
    public function getId() {
        return $this->id;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRole() {
        return $this->role;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
        return $this;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setRole($role) {
        $this->role = $role;
        return $this;
    }

    public function getPlainPassword() {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword) {
        $this->plainPassword = $plainPassword;
        return $this;
    }
    
    public function eraseCredentials() {
        
    }

    public function getRoles() {
        return [$this->role];
    }

    public function getSalt() {
        
    }

    public function getUsername(): string {
        return $this->email;
    }

    public function getFullname()
    {
        return $this->firstname.' '.$this->lastname;
    }
        
    /**
     * Méthode magique appelée qd on essaie d'accéder
     * à l'objet comme chaîne de caractère par exemple
     * par un echo
     * 
     * @return string
     */
    public function __toString() {
        //si on l'appelle en tant que string, on décide qu'elle retourne 
        //le nom de la catégorie
        return $this->getFullname();
    }

    
}
