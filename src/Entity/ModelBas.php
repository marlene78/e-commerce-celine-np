<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModelBasRepository")
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
     */
    private $nom;


    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Image", cascade={"persist", "remove"})
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Finitions", inversedBy="modelBas")
     */
    private $finition;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tissu", inversedBy="modelBas")
     */
    private $tissu;


 


    public function __construct()
    {

        $this->finition = new ArrayCollection();
        $this->tissu = new ArrayCollection();

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
     * @return Collection
     */
     public function getFinition(): ?Finitions
     {
         return $this->finition;
     }

     public function setFinition(?Finitions $finition): self
     {
         $this->finition = $finition;

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


}
