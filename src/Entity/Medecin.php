<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MedecinRepository")
 */
class Medecin
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $civilite;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Patient", mappedBy="fk_medecin_traitant")
     */
    private $patients;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rdv", mappedBy="fk_medecin")
     */
    private $rDVs;

    public function __construct()
    {
        $this->patients = new ArrayCollection();
        $this->rDVs = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nom;
    }

    public function getId()
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
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

    /**
     * @return Collection|Patient[]
     */
    public function getPatients(): Collection
    {
        return $this->patients;
    }

    public function addPatient(Patient $patient): self
    {
        if (!$this->patients->contains($patient)) {
            $this->patients[] = $patient;
            $patient->setFkMedecinTraitant($this);
        }

        return $this;
    }

    public function removePatient(Patient $patient): self
    {
        if ($this->patients->contains($patient)) {
            $this->patients->removeElement($patient);
            // set the owning side to null (unless already changed)
            if ($patient->getFkMedecinTraitant() === $this) {
                $patient->setFkMedecinTraitant(null);
            }
        }

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
            $rDV->setFkMedecin($this);
        }

        return $this;
    }

    public function removeRDV(Rdv $rDV): self
    {
        if ($this->rDVs->contains($rDV)) {
            $this->rDVs->removeElement($rDV);
            // set the owning side to null (unless already changed)
            if ($rDV->getFkMedecin() === $this) {
                $rDV->setFkMedecin(null);
            }
        }

        return $this;
    }
}
