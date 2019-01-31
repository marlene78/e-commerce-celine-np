<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TissuRepository")
 */
class Tissu
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
     */
    private $picture;



    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ModelHaut", mappedBy="tissu")
     */
    private $modelHauts;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ModelBas", mappedBy="tissu")
     */
    private $modelBas;

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

    public function getPicture(): ?Image
    {
        return $this->picture;
    }

    public function setPicture(?Image $picture): self
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
            $modelHaut->addTissu($this);
        }

        return $this;
    }

    public function removeModelHaut(ModelHaut $modelHaut): self
    {
        if ($this->modelHauts->contains($modelHaut)) {
            $this->modelHauts->removeElement($modelHaut);
            $modelHaut->removeTissu($this);
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
            $modelBa->addTissu($this);
        }

        return $this;
    }

    public function removeModelBa(ModelBas $modelBa): self
    {
        if ($this->modelBas->contains($modelBa)) {
            $this->modelBas->removeElement($modelBa);
            $modelBa->removeTissu($this);
        }

        return $this;
    }


}
