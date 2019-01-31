<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FinitionsRepository")
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
     * @ORM\OneToMany(targetEntity="App\Entity\ModelHaut", mappedBy="finition")
     */
    private $modelHauts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ModelBas", mappedBy="finition")
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
            $modelHaut->setFinition($this);
        }

        return $this;
    }

    public function removeModelHaut(ModelHaut $modelHaut): self
    {
        if ($this->modelHauts->contains($modelHaut)) {
            $this->modelHauts->removeElement($modelHaut);
            // set the owning side to null (unless already changed)
            if ($modelHaut->getFinition() === $this) {
                $modelHaut->setFinition(null);
            }
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
            $modelBa->setFinition($this);
        }

        return $this;
    }

    public function removeModelBa(ModelBas $modelBa): self
    {
        if ($this->modelBas->contains($modelBa)) {
            $this->modelBas->removeElement($modelBa);
            // set the owning side to null (unless already changed)
            if ($modelBa->getFinition() === $this) {
                $modelBa->setFinition(null);
            }
        }

        return $this;
    }
}
