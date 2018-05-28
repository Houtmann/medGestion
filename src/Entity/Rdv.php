<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RDVRepository")
 */
class Rdv
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $heure;

    /**
     * @ORM\Column(type="time")
     */
    private $duree;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patient", inversedBy="rDVs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fk_patient;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Medecin", inversedBy="rDVs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fk_medecin;

    public function getId()
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->heure;
    }

    public function setHeure(\DateTimeInterface $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getDuree(): ?\DateTimeInterface
    {
        return $this->duree;
    }

    public function setDuree(\DateTimeInterface $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getFkPatient(): ?Patient
    {
        return $this->fk_patient;
    }

    public function setFkPatient(?Patient $fk_patient): self
    {
        $this->fk_patient = $fk_patient;

        return $this;
    }

    public function getFkMedecin(): ?Medecin
    {
        return $this->fk_medecin;
    }

    public function setFkMedecin(?Medecin $fk_medecin): self
    {
        $this->fk_medecin = $fk_medecin;

        return $this;
    }
}
