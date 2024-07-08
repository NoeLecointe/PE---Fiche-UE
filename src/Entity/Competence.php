<?php

namespace App\Entity;

use App\Repository\CompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetenceRepository::class)]
class Competence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_Competence = null;

    #[ORM\ManyToOne(inversedBy: 'competences')]
    private ?activite $id_Activite = null;

    #[ORM\OneToMany(mappedBy: 'id_Competence', targetEntity: Name::class)]
    private Collection $names;

    public function __construct()
    {
        $this->names = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCompetence(): ?string
    {
        return $this->nom_Competence;
    }

    public function setNomCompetence(string $nom_Competence): self
    {
        $this->nom_Competence = $nom_Competence;

        return $this;
    }

    public function getIdActivite(): ?activite
    {
        return $this->id_Activite;
    }

    public function setIdActivite(?activite $id_Activite): self
    {
        $this->id_Activite = $id_Activite;

        return $this;
    }

    /**
     * @return Collection<int, Name>
     */
    public function getNames(): Collection
    {
        return $this->names;
    }

    public function addName(Name $name): self
    {
        if (!$this->names->contains($name)) {
            $this->names->add($name);
            $name->setIdCompetence($this);
        }

        return $this;
    }

    public function removeName(Name $name): self
    {
        if ($this->names->removeElement($name)) {
            // set the owning side to null (unless already changed)
            if ($name->getIdCompetence() === $this) {
                $name->setIdCompetence(null);
            }
        }

        return $this;
    }
}
