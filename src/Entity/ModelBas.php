<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModelBasRepository")
 * @UniqueEntity("nom")
 */
class ModelBas
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\NotBlank()
     */
    private $nom;


    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Image", cascade={"persist", "remove"})
     *@Assert\NotBlank()
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min = 2,max = 255)
     *@Assert\NotBlank()
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;



    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tissu", inversedBy="modelBas")
     * @Assert\NotBlank()
     */
    private $tissu;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Finitions", inversedBy="modelBas")
     * @Assert\NotBlank()
     */
    private $finition;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;



    public function __construct()
    {


        $this->tissu = new ArrayCollection();
        $this->finition = new ArrayCollection();

    }



    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        $slugify = new Slugify();
        $this->slug = $slugify->slugify($this->nom);

        return $this;
    }



     public function getPicture(): ?Image
     {
         return $this->picture;
     }

     public function setPicture(?Image $picture): self
     {
         $this->picture = $picture;

         return $this;
     }

     public function getDescription(): ?string
     {
         return $this->description;
     }

     public function setDescription(string $description): self
     {
         $this->description = $description;

         return $this;
     }

     public function getPrix(): ?int
     {
         return $this->prix;
     }

     public function setPrix(int $prix): self
     {
         $this->prix = $prix;

         return $this;
     }




     /**
      * @return Collection|Tissu[]
      */
     public function getTissu(): Collection
     {
         return $this->tissu;
     }

     public function addTissu(Tissu $tissu): self
     {
         if (!$this->tissu->contains($tissu)) {
             $this->tissu[] = $tissu;
         }

         return $this;
     }

     public function removeTissu(Tissu $tissu): self
     {
         if ($this->tissu->contains($tissu)) {
             $this->tissu->removeElement($tissu);
         }

         return $this;
     }


     public function __toString()
     {
        return $this->nom;
     }

     /**
      * @return Collection|Finitions[]
      */
     public function getFinition(): Collection
     {
         return $this->finition;
     }

     public function addFinition(Finitions $finition): self
     {
         if (!$this->finition->contains($finition)) {
             $this->finition[] = $finition;
         }

         return $this;
     }

     public function removeFinition(Finitions $finition): self
     {
         if ($this->finition->contains($finition)) {
             $this->finition->removeElement($finition);
         }

         return $this;
     }

     public function getSlug(): ?string
     {
         return $this->slug;
     }

     public function setSlug(string $slug): self
     {
         $this->slug = $slug;

         return $this;
     }






}
