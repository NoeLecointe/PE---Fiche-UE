<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_Formation = null;    
    
    #[ORM\Column(length: 4)]
    private ?string $accronym_Forma = null;
    
    #[ORM\Column(length: 255)]
    private ?string $type_UE = null;

    #[ORM\OneToMany(mappedBy: 'id_Formation', targetEntity: Activite::class)]
    private Collection $activites;

    #[ORM\OneToMany(mappedBy: 'id_Formation', targetEntity: User::class)]
    private Collection $users;

    #[ORM\ManyToMany(targetEntity: FicheUE::class, inversedBy: 'formations')]
    private Collection $fiche_UE;

    #[ORM\ManyToMany(targetEntity: FicheUEAttente::class, inversedBy: 'formations')]
    private Collection $fiche_UE_Attente;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'formations')]
    private Collection $professeurs;

    #[ORM\OneToMany(mappedBy: 'referent', targetEntity: User::class)]
    private Collection $referents;

    public function __construct()
    {
        $this->activites = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->fiche_UE = new ArrayCollection();
        $this->fiche_UE_Attente = new ArrayCollection();
        $this->professeurs = new ArrayCollection();
        $this->referents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFormation(): ?string
    {
        return $this->nom_Formation;
    }

    public function setNomFormation(string $nom_Formation): self
    {
        $this->nom_Formation = $nom_Formation;

        return $this;
    }

    public function getAccronymForma(): ?string
    {
        return $this->accronym_Forma;
    }

    public function setAccronymForma(string $accronym_Forma): self
    {
        $this->accronym_Forma = $accronym_Forma;

        return $this;
    }

    public function getTypeUE(): ?string
    {
        return $this->type_UE;
    }

    public function setTypeUE(string $type_UE): self
    {
        $this->type_UE = $type_UE;

        return $this;
    }

    /**
     * @return Collection<int, Activite>
     */
    public function getActivites(): Collection
    {
        return $this->activites;
    }

    public function addActivite(Activite $activite): self
    {
        if (!$this->activites->contains($activite)) {
            $this->activites->add($activite);
            $activite->setIdFormation($this);
        }

        return $this;
    }

    public function removeActivite(Activite $activite): self
    {
        if ($this->activites->removeElement($activite)) {
            // set the owning side to null (unless already changed)
            if ($activite->getIdFormation() === $this) {
                $activite->setIdFormation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setIdFormation($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getIdFormation() === $this) {
                $user->setIdFormation(null);
            }
        }
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
     * @return Collection<int, User>
     */
    public function getProfesseurs(): Collection
    {
        return $this->professeurs;
    }

    public function addProfesseur(User $professeur): self
    {
        if (!$this->professeurs->contains($professeur)) {
            $this->professeurs->add($professeur);
        }

        return $this;
    }

    public function removeProfesseur(User $professeur): self
    {
        $this->professeurs->removeElement($professeur);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getReferents(): Collection
    {
        return $this->referents;
    }

    public function addReferent(User $referent): self
    {
        if (!$this->referents->contains($referent)) {
            $this->referents->add($referent);
            $referent->setReferent($this);
        }

        return $this;
    }

    public function removeReferent(User $referent): self
    {
        if ($this->referents->removeElement($referent)) {
            // set the owning side to null (unless already changed)
            if ($referent->getReferent() === $this) {
                $referent->setReferent(null);
            }
        }

        return $this;
    }
}
