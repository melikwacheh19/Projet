<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client", indexes={@ORM\Index(name="iduser", columns={"ta"})})
 * @ORM\Entity
 */
class Client
{
    /**
     * @var int
     *
     * @ORM\Column(name="numero_dossier", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $numeroDossier;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=false)
     */
    private $prenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_de_naissance", type="date", nullable=false)
     */
    private $dateDeNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="activite", type="string", length=255, nullable=false)
     */
    private $activite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="date", nullable=false)
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_affectation", type="date", nullable=false)
     */
    private $dateAffectation;

    /**
     * @var string
     *
     * @ORM\Column(name="tel1", type="string", length=255, nullable=false)
     */
    private $tel1;

    /**
     * @var string
     *
     * @ORM\Column(name="tel2", type="string", length=255, nullable=false)
     */
    private $tel2;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=false)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="text", length=65535, nullable=false)
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="cp", type="integer", nullable=false)
     */
    private $cp;

    /**
     * @var int|null
     *
     * @ORM\Column(name="confirmateur", type="integer", nullable=true)
     */
    private $confirmateur;

    /**
     * @var string
     *
     * @ORM\Column(name="Type_de_fiche", type="string", length=255, nullable=false)
     */
    private $typeDeFiche;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=255, nullable=false)
     */
    private $statut;

    /**
     * @var string
     *
     * @ORM\Column(name="organisme", type="string", length=255, nullable=false)
     */
    private $organisme;

    /**
     * @var float
     *
     * @ORM\Column(name="budget", type="float", precision=10, scale=0, nullable=false)
     */
    private $budget;

    /**
     * @var string
     *
     * @ORM\Column(name="matiere", type="string", length=100, nullable=false)
     */
    private $matiere;

    /**
     * @var string
     *
     * @ORM\Column(name="disponibilite", type="string", length=50, nullable=false)
     */
    private $disponibilite;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", length=65535, nullable=false)
     */
    private $commentaire;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float", precision=10, scale=0, nullable=false)
     */
    private $montant;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_rappel_TA", type="date", nullable=true)
     */
    private $dateRappelTa;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="heure_rappel_TA", type="time", nullable=true)
     */
    private $heureRappelTa;

    /**
     * @var string
     *
     * @ORM\Column(name="RDVvalide", type="string", length=100, nullable=false, options={"default"="Non Valide"})
     */
    private $rdvvalide = 'Non Valide';

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ta", referencedColumnName="id")
     * })
     */
    private $ta;

    /**
     * @return int
     */
    public function getNumeroDossier(): int
    {
        return $this->numeroDossier;
    }

    /**
     * @param int $numeroDossier
     */
    public function setNumeroDossier(int $numeroDossier): void
    {
        $this->numeroDossier = $numeroDossier;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return \DateTime
     */
    public function getDateDeNaissance(): \DateTime
    {
        return $this->dateDeNaissance;
    }

    /**
     * @param \DateTime $dateDeNaissance
     */
    public function setDateDeNaissance(\DateTime $dateDeNaissance): void
    {
        $this->dateDeNaissance = $dateDeNaissance;
    }

    /**
     * @return string
     */
    public function getActivite(): string
    {
        return $this->activite;
    }

    /**
     * @param string $activite
     */
    public function setActivite(string $activite): void
    {
        $this->activite = $activite;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreation(): \DateTime
    {
        return $this->dateCreation;
    }

    /**
     * @param \DateTime $dateCreation
     */
    public function setDateCreation(\DateTime $dateCreation): void
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * @return \DateTime
     */
    public function getDateAffectation(): \DateTime
    {
        return $this->dateAffectation;
    }

    /**
     * @param \DateTime $dateAffectation
     */
    public function setDateAffectation(\DateTime $dateAffectation): void
    {
        $this->dateAffectation = $dateAffectation;
    }

    /**
     * @return string
     */
    public function getTel1(): string
    {
        return $this->tel1;
    }

    /**
     * @param string $tel1
     */
    public function setTel1(string $tel1): void
    {
        $this->tel1 = $tel1;
    }

    /**
     * @return string
     */
    public function getTel2(): string
    {
        return $this->tel2;
    }

    /**
     * @param string $tel2
     */
    public function setTel2(string $tel2): void
    {
        $this->tel2 = $tel2;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getVille(): string
    {
        return $this->ville;
    }

    /**
     * @param string $ville
     */
    public function setVille(string $ville): void
    {
        $this->ville = $ville;
    }

    /**
     * @return string
     */
    public function getAdresse(): string
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse(string $adresse): void
    {
        $this->adresse = $adresse;
    }

    /**
     * @return int
     */
    public function getCp(): int
    {
        return $this->cp;
    }

    /**
     * @param int $cp
     */
    public function setCp(int $cp): void
    {
        $this->cp = $cp;
    }

    /**
     * @return int|null
     */
    public function getConfirmateur(): ?int
    {
        return $this->confirmateur;
    }

    /**
     * @param int|null $confirmateur
     */
    public function setConfirmateur(?int $confirmateur): void
    {
        $this->confirmateur = $confirmateur;
    }

    /**
     * @return string
     */
    public function getTypeDeFiche(): string
    {
        return $this->typeDeFiche;
    }

    /**
     * @param string $typeDeFiche
     */
    public function setTypeDeFiche(string $typeDeFiche): void
    {
        $this->typeDeFiche = $typeDeFiche;
    }

    /**
     * @return string
     */
    public function getStatut(): string
    {
        return $this->statut;
    }

    /**
     * @param string $statut
     */
    public function setStatut(string $statut): void
    {
        $this->statut = $statut;
    }

    /**
     * @return string
     */
    public function getOrganisme(): string
    {
        return $this->organisme;
    }

    /**
     * @param string $organisme
     */
    public function setOrganisme(string $organisme): void
    {
        $this->organisme = $organisme;
    }

    /**
     * @return float
     */
    public function getBudget(): float
    {
        return $this->budget;
    }

    /**
     * @param float $budget
     */
    public function setBudget(float $budget): void
    {
        $this->budget = $budget;
    }

    /**
     * @return string
     */
    public function getMatiere(): string
    {
        return $this->matiere;
    }

    /**
     * @param string $matiere
     */
    public function setMatiere(string $matiere): void
    {
        $this->matiere = $matiere;
    }

    /**
     * @return string
     */
    public function getDisponibilite(): string
    {
        return $this->disponibilite;
    }

    /**
     * @param string $disponibilite
     */
    public function setDisponibilite(string $disponibilite): void
    {
        $this->disponibilite = $disponibilite;
    }

    /**
     * @return string
     */
    public function getCommentaire(): string
    {
        return $this->commentaire;
    }

    /**
     * @param string $commentaire
     */
    public function setCommentaire(string $commentaire): void
    {
        $this->commentaire = $commentaire;
    }

    /**
     * @return float
     */
    public function getMontant(): float
    {
        return $this->montant;
    }

    /**
     * @param float $montant
     */
    public function setMontant(float $montant): void
    {
        $this->montant = $montant;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateRappelTa(): ?\DateTime
    {
        return $this->dateRappelTa;
    }

    /**
     * @param \DateTime|null $dateRappelTa
     */
    public function setDateRappelTa(?\DateTime $dateRappelTa): void
    {
        $this->dateRappelTa = $dateRappelTa;
    }

    /**
     * @return \DateTime|null
     */
    public function getHeureRappelTa(): ?\DateTime
    {
        return $this->heureRappelTa;
    }

    /**
     * @param \DateTime|null $heureRappelTa
     */
    public function setHeureRappelTa(?\DateTime $heureRappelTa): void
    {
        $this->heureRappelTa = $heureRappelTa;
    }

    /**
     * @return string
     */
    public function getRdvvalide(): string
    {
        return $this->rdvvalide;
    }

    /**
     * @param string $rdvvalide
     */
    public function setRdvvalide(string $rdvvalide): void
    {
        $this->rdvvalide = $rdvvalide;
    }

    /**
     * @return User
     */
    public function getTa(): User
    {
        return $this->ta;
    }

    /**
     * @param User $ta
     */
    public function setTa(User $ta): void
    {
        $this->ta = $ta;
    }



}
