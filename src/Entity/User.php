<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User extends \FOS\UserBundle\Model\User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\UserIdentity", mappedBy="user", cascade={"persist", "remove"})
     */
    private $userIdentity;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Mensurations", mappedBy="user", cascade={"persist", "remove"})
     */
    private $mensurations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="user")
     */
    private $commande;

    public function __construct()
    {
        parent::__construct();
        $this->commande = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserIdentity(): ?UserIdentity
    {
        return $this->userIdentity;
    }

    public function setUserIdentity(?UserIdentity $userIdentity): self
    {
        $this->userIdentity = $userIdentity;

        // set (or unset) the owning side of the relation if necessary
        $newUser = $userIdentity === null ? null : $this;
        if ($newUser !== $userIdentity->getUser()) {
            $userIdentity->setUser($newUser);
        }

        return $this;
    }

    public function getMensurations(): ?Mensurations
    {
        return $this->mensurations;
    }

    public function setMensurations(?Mensurations $mensurations): self
    {
        $this->mensurations = $mensurations;

        // set (or unset) the owning side of the relation if necessary
        $newUser = $mensurations === null ? null : $this;
        if ($newUser !== $mensurations->getUser()) {
            $mensurations->setUser($newUser);
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommande(): Collection
    {
        return $this->commande;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commande->contains($commande)) {
            $this->commande[] = $commande;
            $commande->setUser($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commande->contains($commande)) {
            $this->commande->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getUser() === $this) {
                $commande->setUser(null);
            }
        }

        return $this;
    }






}
