<?php

namespace App\Entity;

use App\Repository\FicheUEAttenteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FicheUEAttenteRepository::class)]
class FicheUEAttente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 8, unique: true)]
    private ?string $code_UE = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $nom_UE = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $categorie_UE = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $periode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cible = null;

    #[ORM\Column(nullable: true)]
    private ?int $credits = null;

    #[ORM\Column(nullable: true)]
    private ?int $heure_CM = null;

    #[ORM\Column(nullable: true)]
    private ?int $heure_TD = null;

    #[ORM\Column(nullable: true)]
    private ?int $heure_TP = null;

    #[ORM\Column(nullable: true)]
    private ?int $heure_THE = null;

    #[ORM\Column(nullable: true)]
    private ?bool $projet = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $antecedent = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $niv_Francais = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $anglais = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $modalite = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $acquis = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $savoir = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $techniques = null;

    #[ORM\Column(nullable: true)]
    private ?bool $mineur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mineur_Concerne = null;

    #[ORM\Column(nullable: true)]
    private ?bool $alternance = null;

    #[ORM\Column(nullable: true)]
    private ?bool $label_DDRS = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $label_DDRS_prec = null;

    #[ORM\Column(nullable: true)]
    private ?bool $label_Recherche = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $label_Recherche_prec = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $commentaire = null;

    #[ORM\OneToMany(mappedBy: 'fiche_UE_Attente', targetEntity: Name::class)]
    private Collection $names;

    #[ORM\ManyToMany(targetEntity: Formation::class, mappedBy: 'fiche_UE_Attente')]
    private Collection $formations;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'fiche_UE_Attente')]
    private Collection $users;

    #[ORM\Column(nullable: false)]
    private ?bool $validation = false;

    public function __construct()
    {
        $this->names = new ArrayCollection();
        $this->formations = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeUE(): ?string
    {
        return $this->code_UE;
    }

    public function setCodeUE(string $code_UE): self
    {
        $this->code_UE = $code_UE;

        return $this;
    }

    public function getNomUE(): ?string
    {
        return $this->nom_UE;
    }

    public function setNomUE(?string $nom_UE): self
    {
        $this->nom_UE = $nom_UE;

        return $this;
    }

    public function getCategorieUE(): ?string
    {
        return $this->categorie_UE;
    }

    public function setCategorieUE(?string $categorie_UE): self
    {
        $this->categorie_UE = $categorie_UE;

        return $this;
    }

    public function getPeriode(): ?string
    {
        return $this->periode;
    }

    public function setPeriode(?string $periode): self
    {
        $this->periode = $periode;

        return $this;
    }

    public function getCible(): ?string
    {
        return $this->cible;
    }

    public function setCible(?string $cible): self
    {
        $this->cible = $cible;

        return $this;
    }

    public function getCredits(): ?int
    {
        return $this->credits;
    }

    public function setCredits(?int $credits): self
    {
        $this->credits = $credits;

        return $this;
    }

    public function getHeureCM(): ?int
    {
        return $this->heure_CM;
    }

    public function setHeureCM(?int $heure_CM): self
    {
        $this->heure_CM = $heure_CM;

        return $this;
    }

    public function getHeureTD(): ?int
    {
        return $this->heure_TD;
    }

    public function setHeureTD(?int $heure_TD): self
    {
        $this->heure_TD = $heure_TD;

        return $this;
    }

    public function getHeureTP(): ?int
    {
        return $this->heure_TP;
    }

    public function setHeureTP(?int $heure_TP): self
    {
        $this->heure_TP = $heure_TP;

        return $this;
    }

    public function getHeureTHE(): ?int
    {
        return $this->heure_THE;
    }

    public function setHeureTHE(?int $heure_THE): self
    {
        $this->heure_THE = $heure_THE;

        return $this;
    }

    public function isProjet(): ?bool
    {
        return $this->projet;
    }

    public function setProjet(?bool $projet): self
    {
        $this->projet = $projet;

        return $this;
    }

    public function getantecedent(): ?string
    {
        return $this->antecedent;
    }

    public function setantecedent(?string $antecedent): self
    {
        $this->antecedent = $antecedent;

        return $this;
    }

    public function getNivFrancais(): ?string
    {
        return $this->niv_Francais;
    }

    public function setNivFrancais(?string $niv_Francais): self
    {
        $this->niv_Francais = $niv_Francais;

        return $this;
    }

    public function getAnglais(): ?string
    {
        return $this->anglais;
    }

    public function setAnglais(?string $anglais): self
    {
        $this->anglais = $anglais;

        return $this;
    }

    public function getModalite(): ?string
    {
        return $this->modalite;
    }

    public function setModalite(?string $modalite): self
    {
        $this->modalite = $modalite;

        return $this;
    }

    public function getAcquis(): ?string
    {
        return $this->acquis;
    }

    public function setAcquis(?string $acquis): self
    {
        $this->acquis = $acquis;

        return $this;
    }

    public function getSavoir(): ?string
    {
        return $this->savoir;
    }

    public function setSavoir(?string $savoir): self
    {
        $this->savoir = $savoir;

        return $this;
    }

    public function getTechniques(): ?string
    {
        return $this->techniques;
    }

    public function setTechniques(?string $techniques): self
    {
        $this->techniques = $techniques;

        return $this;
    }

    public function isMineur(): ?bool
    {
        return $this->mineur;
    }

    public function setMineur(?bool $mineur): self
    {
        $this->mineur = $mineur;

        return $this;
    }

    public function getMineurConcerne(): ?string
    {
        return $this->mineur_Concerne;
    }

    public function setMineurConcerne(?string $mineur_Concerne): self
    {
        $this->mineur_Concerne = $mineur_Concerne;

        return $this;
    }

    public function getAlternance(): ?string
    {
        return $this->alternance;
    }

    public function setAlternance(?string $alternance): self
    {
        $this->alternance = $alternance;

        return $this;
    }

    public function isLabelDDRS(): ?bool
    {
        return $this->label_DDRS;
    }

    public function setLabelDDRS(?bool $label_DDRS): self
    {
        $this->label_DDRS = $label_DDRS;

        return $this;
    }

    public function getLabelDDRSPrec(): ?string
    {
        return $this->label_DDRS_prec;
    }

    public function setLabelDDRSPrec(?string $label_DDRS_prec): self
    {
        $this->label_DDRS_prec = $label_DDRS_prec;

        return $this;
    }

    public function isLabelRecherche(): ?bool
    {
        return $this->label_Recherche;
    }

    public function setLabelRecherche(?bool $label_Recherche): self
    {
        $this->label_Recherche = $label_Recherche;

        return $this;
    }

    public function getLabelRecherchePrec(): ?string
    {
        return $this->label_Recherche_prec;
    }

    public function setLabelRecherchePrec(?string $label_Recherche_prec): self
    {
        $this->label_Recherche_prec = $label_Recherche_prec;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

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
            $name->setFicheUEAttente($this);
        }

        return $this;
    }

    public function removeName(Name $name): self
    {
        if ($this->names->removeElement($name)) {
            // set the owning side to null (unless already changed)
            if ($name->getFicheUEAttente() === $this) {
                $name->setFicheUEAttente(null);
            }
        }

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
            $formation->addFicheUEAttente($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formations->removeElement($formation)) {
            $formation->removeFicheUEAttente($this);
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
            $user->addFicheUEAttente($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeFicheUEAttente($this);
        }

        return $this;
    }

    public function getValidation(): ?int
    {
        return $this->validation;
    }

    public function setValidation(?int $validation): self
    {
        $this->validation = $validation;

        return $this;
    }
}
