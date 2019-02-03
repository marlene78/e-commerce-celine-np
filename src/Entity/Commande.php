<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
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
    private $modeleHaut;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modeleBas;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $finition;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $accessoire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tissu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModeleHaut(): ?string
    {
        return $this->modeleHaut;
    }

    public function setModeleHaut(string $modeleHaut): self
    {
        $this->modeleHaut = $modeleHaut;

        return $this;
    }

    public function getModeleBas(): ?string
    {
        return $this->modeleBas;
    }

    public function setModeleBas(string $modeleBas): self
    {
        $this->modeleBas = $modeleBas;

        return $this;
    }

    public function getFinition(): ?string
    {
        return $this->finition;
    }

    public function setFinitionHaut(?string $finition): self
    {
        $this->finition = $finition;

        return $this;
    }



    public function getAccessoire(): ?string
    {
        return $this->accessoire;
    }

    public function setAccessoire(string $accessoire): self
    {
        $this->accessoire = $accessoire;

        return $this;
    }

    public function getTissu(): ?string
    {
        return $this->tissu;
    }

    public function setTissu(string $tissu): self
    {
        $this->tissu = $tissu;

        return $this;
    }
}
