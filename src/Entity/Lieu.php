<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LieuRepository")
 */
class Lieu
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
    private $lieu;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Voiture", mappedBy="lieu", cascade={"persist", "remove"})
     */
    private $voiture;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="lieu")
     */
    private $lieu_id;

    public function __construct()
    {
        $this->lieu_id = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * @return Collection|Voiture[]
     */
    public function getVoiture(): Collection
    {
        return $this->voiture;
    }

    public function addVoiture(Voiture $voiture): self
    {
        if (!$this->voiture->contains($voiture)) {
            $this->voiture[] = $voiture;
            $voiture->setLieu($this);
        }

        return $this;
    }

    public function removeVoiture(Voiture $voiture): self
    {
        if ($this->voiture->contains($voiture)) {
            $this->voiture->removeElement($voiture);
            // set the owning side to null (unless already changed)
            if ($voiture->getLieu() === $this) {
                $voiture->setLieu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getLieuId(): Collection
    {
        return $this->lieu_id;
    }

    public function addLieuId(Reservation $lieuId): self
    {
        if (!$this->lieu_id->contains($lieuId)) {
            $this->lieu_id[] = $lieuId;
            $lieuId->setLieu($this);
        }

        return $this;
    }

    public function removeLieuId(Reservation $lieuId): self
    {
        if ($this->lieu_id->contains($lieuId)) {
            $this->lieu_id->removeElement($lieuId);
            // set the owning side to null (unless already changed)
            if ($lieuId->getLieu() === $this) {
                $lieuId->setLieu(null);
            }
        }

        return $this;
    }

}
