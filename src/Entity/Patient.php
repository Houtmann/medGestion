<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PatientRepository")
 */
class Patient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $civilite;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $adresse;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="integer")
     */
    private $numSecu;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Medecin", inversedBy="patients")
     */
    private $fk_medecin_traitant;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rdv", mappedBy="fk_patient")
     */
    private $rDVs;

    public function __construct()
    {
        $this->rDVs = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(string $civilite): self
    {
        $this->civilite = $civilite;

        return $this;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getNumSecu(): ?int
    {
        return $this->numSecu;
    }

    public function setNumSecu(int $numSecu): self
    {
        $this->numSecu = $numSecu;

        return $this;
    }

    public function getFkMedecinTraitant(): ?Medecin
    {
        return $this->fk_medecin_traitant;
    }

    public function setFkMedecinTraitant(?Medecin $fk_medecin_traitant): self
    {
        $this->fk_medecin_traitant = $fk_medecin_traitant;

        return $this;
    }

    /**
     * @return Collection|Rdv[]
     */
    public function getRDVs(): Collection
    {
        return $this->rDVs;
    }

    public function addRDV(Rdv $rDV): self
    {
        if (!$this->rDVs->contains($rDV)) {
            $this->rDVs[] = $rDV;
            $rDV->setFkPatient($this);
        }

        return $this;
    }

    public function removeRDV(Rdv $rDV): self
    {
        if ($this->rDVs->contains($rDV)) {
            $this->rDVs->removeElement($rDV);
            // set the owning side to null (unless already changed)
            if ($rDV->getFkPatient() === $this) {
                $rDV->setFkPatient(null);
            }
        }

        return $this;
    }
}
