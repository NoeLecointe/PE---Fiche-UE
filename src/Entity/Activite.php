<?php

namespace App\Entity;

use App\Repository\ActiviteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActiviteRepository::class)]
class Activite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 2)]
    private ?string $id_act = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'activites')]
    private ?formation $id_Formation = null;

    #[ORM\OneToMany(mappedBy: 'id_Activite', targetEntity: Competence::class)]
    private Collection $competences;

    
    public function __construct()
    {
        $this->competences = new ArrayCollection();
    }

    public function getId(): ?int
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

    public function getIdFormation(): ?formation
    {
        return $this->id_Formation;
    }

    public function setIdFormation(?formation $id_Formation): self
    {
        $this->id_Formation = $id_Formation;

        return $this;
    }

    /**
     * @return Collection<int, Competence>
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competence $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences->add($competence);
            $competence->setIdActivite($this);
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): self
    {
        if ($this->competences->removeElement($competence)) {
            // set the owning side to null (unless already changed)
            if ($competence->getIdActivite() === $this) {
                $competence->setIdActivite(null);
            }
        }

        return $this;
    }

    public function getid_act(): ?int
    {
        return $this->id_act;
    }

    public function setid_act(int $id_act): self
    {
        $this->id_act = $id_act;

        return $this;
    }
}
