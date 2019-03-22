<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FinitionsRepository")
 * @UniqueEntity("nom")
 *
 */
class Finitions
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
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Image", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $picture;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ModelHaut", mappedBy="finition")
     */
    private $modelHauts;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ModelBas", mappedBy="finition")
     */
    private $modelBas;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;



    public function __construct()
    {
        $this->modelHauts = new ArrayCollection();
        $this->modelBas = new ArrayCollection();

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

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getPicture(): ?Image
    {
        return $this->picture;
    }

    public function setPicture(Image $picture): self
    {
        $this->picture = $picture;

        return $this;
    }


    public function __toString()
    {
        return $this->nom;
    }

    /**
     * @return Collection|ModelHaut[]
     */
    public function getModelHauts(): Collection
    {
        return $this->modelHauts;
    }

    public function addModelHaut(ModelHaut $modelHaut): self
    {
        if (!$this->modelHauts->contains($modelHaut)) {
            $this->modelHauts[] = $modelHaut;
            $modelHaut->addFinition($this);
        }

        return $this;
    }

    public function removeModelHaut(ModelHaut $modelHaut): self
    {
        if ($this->modelHauts->contains($modelHaut)) {
            $this->modelHauts->removeElement($modelHaut);
            $modelHaut->removeFinition($this);
        }

        return $this;
    }

    /**
     * @return Collection|ModelBas[]
     */
    public function getModelBas(): Collection
    {
        return $this->modelBas;
    }

    public function addModelBa(ModelBas $modelBa): self
    {
        if (!$this->modelBas->contains($modelBa)) {
            $this->modelBas[] = $modelBa;
            $modelBa->addFinition($this);
        }

        return $this;
    }

    public function removeModelBa(ModelBas $modelBa): self
    {
        if ($this->modelBas->contains($modelBa)) {
            $this->modelBas->removeElement($modelBa);
            $modelBa->removeFinition($this);
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
