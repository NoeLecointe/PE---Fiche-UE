<?php

namespace App\Entity;

use App\Repository\FicheUERepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FicheUERepository::class)]
class FicheUE
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 8, unique: true)]
    private ?string $code_ue = null;

    #[ORM\Column(length: 100)]
    private ?string $nom_ue = null;

    #[ORM\Column(length: 2)]
    private ?string $categorie_ue = null;

    #[ORM\Column(length: 255)]
    private ?string $periode = null;
    
    #[ORM\Column(length: 255)]
    private ?string $cible = null;

    #[ORM\Column]
    private ?int $credits = null;

    #[ORM\Column]
    private ?int $heure_cm = null;

    #[ORM\Column]
    private ?int $heure_td = null;

    #[ORM\Column]
    private ?int $heure_tp = null;

    #[ORM\Column]
    private ?int $heure_the = null;

    #[ORM\Column]
    private ?bool $projet = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $antecedent = null;

    #[ORM\Column(length: 2)]
    private ?string $niv_francais = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $anglais = null;

    #[ORM\Column(length: 255)]
    private ?string $modalite = null;

    #[ORM\Column(length: 1000)]
    private ?string $acquis = null;

    #[ORM\Column(length: 1000)]
    private ?string $savoir = null;

    #[ORM\Column(length: 1000)]
    private ?string $techniques = null;

    #[ORM\Column]
    private ?bool $mineur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mineur_concerne = null;

    #[ORM\Column()]
    private ?bool $alternance = null;

    #[ORM\Column]
    private ?bool $label_ddrs = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $label_ddrs_prec = null;

    #[ORM\Column]
    private ?bool $label_recherche = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $label_recherche_prec = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $commentaire = null;

    #[ORM\OneToMany(mappedBy: 'code_ue', targetEntity: Name::class, orphanRemoval: true)]
    private Collection $names;

    #[ORM\ManyToMany(targetEntity: Formation::class, mappedBy: 'fiche_UE')]
    private Collection $formations;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'fiche_UE')]
    private Collection $users;

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
        return $this->code_ue;
    }

    public function setCodeUE(string $code_ue): self
    {
        $this->code_ue = $code_ue;

        return $this;
    }

    public function getNomUE(): ?string
    {
        return $this->nom_ue;
    }

    public function setNomUE(string $nom_ue): self
    {
        $this->nom_ue = $nom_ue;

        return $this;
    }

    public function getCategorieUE(): ?string
    {
        return $this->categorie_ue;
    }

    public function setCategorieUE(string $categorie_ue): self
    {
        $this->categorie_ue = $categorie_ue;

        return $this;
    }

    public function getPeriode(): ?string
    {
        return $this->periode;
    }

    public function setPeriode(string $periode): self
    {
        $this->periode = $periode;

        return $this;
    }

    public function getCible(): ?string
    {
        return $this->cible;
    }

    public function setCible(string $cible): self
    {
        $this->cible = $cible;

        return $this;
    }

    public function getCredits(): ?int
    {
        return $this->credits;
    }

    public function setCredits(int $credits): self
    {
        $this->credits = $credits;

        return $this;
    }

    public function getHeureCM(): ?int
    {
        return $this->heure_cm;
    }

    public function setHeureCM(int $heure_cm): self
    {
        $this->heure_cm = $heure_cm;

        return $this;
    }

    public function getHeureTD(): ?int
    {
        return $this->heure_td;
    }

    public function setHeureTD(int $heure_td): self
    {
        $this->heure_td = $heure_td;

        return $this;
    }

    public function getHeureTP(): ?int
    {
        return $this->heure_tp;
    }

    public function setHeureTP(int $heure_tp): self
    {
        $this->heure_tp = $heure_tp;

        return $this;
    }

    public function getHeureTHE(): ?int
    {
        return $this->heure_the;
    }

    public function setHeureTHE(int $heure_the): self
    {
        $this->heure_the = $heure_the;

        return $this;
    }

    public function isProjet(): ?bool
    {
        return $this->projet;
    }

    public function setProjet(bool $projet): self
    {
        $this->projet = $projet;

        return $this;
    }

    public function getAntecedent(): ?string
    {
        return $this->antecedent;
    }

    public function setAntecedent(?string $antecedent): self
    {
        $this->antecedent = $antecedent;

        return $this;
    }

    public function getNivFrancais(): ?string
    {
        return $this->niv_francais;
    }

    public function setNivFrancais(string $niv_francais): self
    {
        $this->niv_francais = $niv_francais;

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

    public function setModalite(string $modalite): self
    {
        $this->modalite = $modalite;

        return $this;
    }

    public function getAcquis(): ?string
    {
        return $this->acquis;
    }

    public function setAcquis(string $acquis): self
    {
        $this->acquis = $acquis;

        return $this;
    }

    public function getSavoir(): ?string
    {
        return $this->savoir;
    }

    public function setSavoir(string $savoir): self
    {
        $this->savoir = $savoir;

        return $this;
    }

    public function getTechniques(): ?string
    {
        return $this->techniques;
    }

    public function setTechniques(string $techniques): self
    {
        $this->techniques = $techniques;

        return $this;
    }

    public function isMineur(): ?bool
    {
        return $this->mineur;
    }

    public function setMineur(bool $mineur): self
    {
        $this->mineur = $mineur;

        return $this;
    }

    public function getMineurConcerne(): ?string
    {
        return $this->mineur_concerne;
    }

    public function setMineurConcerne(?string $mineur_concerne): self
    {
        $this->mineur_concerne = $mineur_concerne;

        return $this;
    }

    public function getAlternance(): ?string
    {
        return $this->alternance;
    }

    public function setAlternance(string $alternance): self
    {
        $this->alternance = $alternance;

        return $this;
    }

    public function isLabelDDRS(): ?bool
    {
        return $this->label_ddrs;
    }

    public function setLabelDDRS(bool $label_ddrs): self
    {
        $this->label_ddrs = $label_ddrs;

        return $this;
    }

    public function getLabelDDRSPrec(): ?string
    {
        return $this->label_ddrs_prec;
    }

    public function setLabelDDRSPrec(?string $label_ddrs_prec): self
    {
        $this->label_ddrs_prec = $label_ddrs_prec;

        return $this;
    }

    public function isLabelRecherche(): ?bool
    {
        return $this->label_recherche;
    }

    public function setLabelRecherche(bool $label_recherche): self
    {
        $this->label_recherche = $label_recherche;

        return $this;
    }

    public function getLabelRecherchePrec(): ?string
    {
        return $this->label_recherche_prec;
    }

    public function setLabelRecherchePrec(?string $label_recherche_prec): self
    {
        $this->label_recherche_prec = $label_recherche_prec;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
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
            $name->setCodeUE($this);
        }

        return $this;
    }

    public function removeName(Name $name): self
    {
        if ($this->names->removeElement($name)) {
            // set the owning side to null (unless already changed)
            if ($name->getCodeUE() === $this) {
                $name->setCodeUE(null);
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
            $formation->addFicheUE($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formations->removeElement($formation)) {
            $formation->removeFicheUE($this);
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
            $user->addFicheUE($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeFicheUE($this);
        }
        return $this;
    }
}
