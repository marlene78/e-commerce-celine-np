<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;




class Contact
{

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min = 2,max = 50)
     */
	private $nom; 

	 /**
	 * @var string|null
     * @Assert\Type(type="string")
     * @Assert\NotBlank()
     * @Assert\Length(min = 2,max = 50)
     */
	private $prenom; 



	 /**
	 * @var string|null
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     * @Assert\Email()
     */
	private $email; 


	/**
	 * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min = 2)
     */
	private $message;


    /**
     * @var string|null
     * @Assert\NotBlank()
     */
	private $sujet;

    /**
     * @return string|null
     */
    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    /**
     * @param string|null $sujet
     * @return Contact
     */
    public function setSujet(?string $sujet): Contact
    {
        $this->sujet = $sujet;
        return $this;
    }




    /**
     * @return string|null
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string|null $nom
     * @return Contact
     */
    public function setNom(?string $nom): Contact
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    /**
     * @param string|null $prenom
     * @return Contact
     */
    public function setPrenom(?string $prenom): Contact
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Contact
     */
    public function setEmail(?string $email): Contact
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     * @return Contact
     */
    public function setMessage(?string $message): Contact
    {
        $this->message = $message;
        return $this;
    }





}