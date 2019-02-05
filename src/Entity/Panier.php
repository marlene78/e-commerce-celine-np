<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PanierRepository")
 */
class Panier
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
    private $finitionHaut;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $finitionBas;




    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $accessoire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tissuHaut;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tissuBas;





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



    public function getAccessoire(): ?string
    {
        return $this->accessoire;
    }

    public function setAccessoire(string $accessoire): self
    {
        $this->accessoire = $accessoire;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFinitionHaut()
    {
        return $this->finitionHaut;
    }

    /**
     * @param mixed $finitionHaut
     */
    public function setFinitionHaut($finitionHaut): void
    {
        $this->finitionHaut = $finitionHaut;
    }

    /**
     * @return mixed
     */
    public function getFinitionBas()
    {
        return $this->finitionBas;
    }

    /**
     * @param mixed $finitionBas
     */
    public function setFinitionBas($finitionBas): void
    {
        $this->finitionBas = $finitionBas;
    }

    /**
     * @return mixed
     */
    public function getTissuHaut()
    {
        return $this->tissuHaut;
    }

    /**
     * @param mixed $tissuHaut
     */
    public function setTissuHaut($tissuHaut): void
    {
        $this->tissuHaut = $tissuHaut;
    }

    /**
     * @return mixed
     */
    public function getTissuBas()
    {
        return $this->tissuBas;
    }

    /**
     * @param mixed $tissuBas
     */
    public function setTissuBas($tissuBas): void
    {
        $this->tissuBas = $tissuBas;
    }





}
