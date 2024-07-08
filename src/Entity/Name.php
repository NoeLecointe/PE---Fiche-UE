<?php

namespace App\Entity;

use App\Repository\NameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NameRepository::class)]
class Name
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'names')]
    private ?FicheUE $code_UE = null;

    #[ORM\ManyToOne(inversedBy: 'names')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Competence $id_Competence = null;

    #[ORM\Column(nullable: false)]
    private ?int $notion = 0;

    #[ORM\Column(nullable: false)]
    private ?int $application = 0;

    #[ORM\Column(nullable: false)]
    private ?int $maitrise = 0;

    #[ORM\Column(nullable: false)]
    private ?int $expertise = 0;

    #[ORM\ManyToOne(inversedBy: 'names')]
    private ?FicheUEAttente $fiche_UE_Attente = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeUE(): ?FicheUE
    {
        return $this->code_UE;
    }

    public function setCodeUE(?FicheUE $code_UE): self
    {
        $this->code_UE = $code_UE;

        return $this;
    }

    public function getIdCompetence(): ?Competence
    {
        return $this->id_Competence;
    }

    public function setIdCompetence(?Competence $id_Competence): self
    {
        $this->id_Competence = $id_Competence;

        return $this;
    }

    public function getNotion(): ?int
    {
        return $this->notion;
    }

    public function setNotion(?int $notion): self
    {
        $this->notion = $notion;

        return $this;
    }

    public function getApplication(): ?int
    {
        return $this->application;
    }

    public function setApplication(?int $application): self
    {
        $this->application = $application;

        return $this;
    }

    public function getMaitrise(): ?int
    {
        return $this->maitrise;
    }

    public function setMaitrise(?int $maitrise): self
    {
        $this->maitrise = $maitrise;

        return $this;
    }

    public function getExpertise(): ?int
    {
        return $this->expertise;
    }

    public function setExpertise(?int $expertise): self
    {
        $this->expertise = $expertise;

        return $this;
    }

    public function getFicheUEAttente(): ?FicheUEAttente
    {
        return $this->fiche_UE_Attente;
    }

    public function setFicheUEAttente(?FicheUEAttente $fiche_UE_Attente): self
    {
        $this->fiche_UE_Attente = $fiche_UE_Attente;

        return $this;
    }
}
