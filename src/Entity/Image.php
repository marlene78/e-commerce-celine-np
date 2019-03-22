<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 * @Vich\Uploadable
 */
class Image
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $alt;


    /**
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $imageSize;


    /**
     * @ORM\Column(type="datetime")
     */
    private $updateAt;

    /**
     * @var File
     * @Assert\NotBlank()
     *  @Vich\UploadableField(mapping="product_image_presentation", fileNameProperty="nom", size="imageSize")
     */
    private $imageFile;


    public function __toString()
    {
        return $this->alt;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom = null): self
    {
        $this->nom = $nom;

        return $this;
    }



    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(?string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }



    /**
     * @return int
     */
    public function getImageSize(): int
    {
        return $this->imageSize;
    }

    /**
     * @param int $imageSize
     */
    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }



    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }



    /**
     * @param File $imageFile
     * @throws \Exception
     */
    public function setImageFile(File $imageFile = null): void
    {
        $this->imageFile = $imageFile;
        if(!is_null($imageFile)) {
            // on provoque l'upload
            $this->updateAt = new \DateTimeImmutable();
        }
    }

   




}
