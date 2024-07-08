<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $mdp = null;

    #[ORM\Column]
    private ?int $statut = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?formation $id_Formation = null;

    #[ORM\ManyToMany(targetEntity: FicheUE::class, inversedBy: 'users')]
    private Collection $fiche_UE;

    #[ORM\ManyToMany(targetEntity: FicheUEAttente::class, inversedBy: 'users')]
    private Collection $fiche_UE_Attente;

    #[ORM\ManyToMany(targetEntity: Formation::class, mappedBy: 'professeurs')]
    private Collection $formations;

    #[ORM\ManyToOne(inversedBy: 'referents')]
    private ?formation $referent = null;

    public function __construct()
    {
        $this->fiche_UE = new ArrayCollection();
        $this->fiche_UE_Attente = new ArrayCollection();
        $this->formations = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getStatut(): ?int
    {
        return $this->statut;
    }

    public function setStatut(int $statut): self
    {
        $this->statut = $statut;

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
     * @return Collection<int, FicheUE>
     */
    public function getFicheUE(): Collection
    {
        return $this->fiche_UE;
    }

    public function addFicheUE(FicheUE $FicheUE): self
    {
        if (!$this->fiche_UE->contains($FicheUE)) {
            $this->fiche_UE->add($FicheUE);
        }

        return $this;
    }

    public function removeFicheUE(FicheUE $FicheUE): self
    {
        $this->fiche_UE->removeElement($FicheUE);

        return $this;
    }

    /**
     * @return Collection<int, FicheUEAttente>
     */
    public function getFicheUEAttente(): Collection
    {
        return $this->fiche_UE_Attente;
    }

    public function addFicheUEAttente(FicheUEAttente $FicheUEAttente): self
    {
        if (!$this->fiche_UE_Attente->contains($FicheUEAttente)) {
            $this->fiche_UE_Attente->add($FicheUEAttente);
        }

        return $this;
    }

    public function removeFicheUEAttente(FicheUEAttente $FicheUEAttente): self
    {
        $this->fiche_UE_Attente->removeElement($FicheUEAttente);

        return $this;
    }

    /**
     * @return Collection<int, Formation>
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->formations->contains($formation)) {
            $this->formations->add($formation);
            $formation->addProfesseur($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formations->removeElement($formation)) {
            $formation->removeProfesseur($this);
        }

        return $this;
    }

    public function getReferent(): ?formation
    {
        return $this->referent;
    }

    public function setReferent(?formation $referent): self
    {
        $this->referent = $referent;

        return $this;
    }
}
