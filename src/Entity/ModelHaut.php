<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ModelHautRepository")
 * @UniqueEntity("nom")
 * @ORM\HasLifecycleCallbacks
 *
 */
class ModelHaut
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Tissu", inversedBy="modelHauts")
     */
    private $tissu;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Finitions", inversedBy="modelHauts")
     */
    private $finition;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * Permet d'initialiser le slug
     *  @ORM\PrePersist
     *  @ORM\PreUpdate
     */
    public function initialiazeSlug()
    {
        if(empty($this->slug)){
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->nom);
        }
    }






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

    public function removeFifinition(Finitions $finition): self
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
