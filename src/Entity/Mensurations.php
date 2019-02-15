<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MensurationsRepository")
 */
class Mensurations
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
    private $taille;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tourDePoitrine;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tourDeHanche;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tourDeTaille;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tourDeCuisse;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="mensurations", cascade={"persist", "remove"})
     */
    private $user;







    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(string $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getTourDePoitrine(): ?string
    {
        return $this->tourDePoitrine;
    }

    public function setTourDePoitrine(string $tourDePoitrine): self
    {
        $this->tourDePoitrine = $tourDePoitrine;

        return $this;
    }

    public function getTourDeHanche(): ?string
    {
        return $this->tourDeHanche;
    }

    public function setTourDeHanche(string $tourDeHanche): self
    {
        $this->tourDeHanche = $tourDeHanche;

        return $this;
    }

    public function getTourDeTaille(): ?string
    {
        return $this->tourDeTaille;
    }

    public function setTourDeTaille(string $tourDeTaille): self
    {
        $this->tourDeTaille = $tourDeTaille;

        return $this;
    }

    public function getTourDeCuisse(): ?string
    {
        return $this->tourDeCuisse;
    }

    public function setTourDeCuisse(string $tourDeCuisse): self
    {
        $this->tourDeCuisse = $tourDeCuisse;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }





}
