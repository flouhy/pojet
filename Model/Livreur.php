<?php
class Livreur
{
    private ?int $id_livreur = null;
    private ?string $Nom_livreur = null;
    private ?string $Prenom_Livreur = null;
    private ?string $Secteur = null;
    private ?string $mail = null;  // Added mail property

    // Constructor with parameters
    public function __construct(string $Nom_livreur, string $Prenom_Livreur, string $Secteur, ?string $mail = null, ?int $id_livreur = null)
    {
        $this->id_livreur = $id_livreur;
        $this->Nom_livreur = $Nom_livreur;
        $this->Prenom_Livreur = $Prenom_Livreur;
        $this->Secteur = $Secteur;
        $this->mail = $mail;  // Initialize mail
    }

    // Getter for id_livreur
    public function getIdLivreur(): ?int
    {
        return $this->id_livreur;
    }

    // Getter for Nom_livreur
    public function getNomLivreur(): ?string
    {
        return $this->Nom_livreur;
    }

    // Setter for Nom_livreur
    public function setNomLivreur(string $Nom_livreur): void
    {
        $this->Nom_livreur = $Nom_livreur;
    }

    // Getter for Prenom_Livreur
    public function getPrenomLivreur(): ?string
    {
        return $this->Prenom_Livreur;
    }

    // Setter for Prenom_Livreur
    public function setPrenomLivreur(string $Prenom_Livreur): void
    {
        $this->Prenom_Livreur = $Prenom_Livreur;
    }

    // Getter for Secteur
    public function getSecteur(): ?string
    {
        return $this->Secteur;
    }

    // Setter for Secteur
    public function setSecteur(string $Secteur): void
    {
        $this->Secteur = $Secteur;
    }

    // Getter for mail
    public function getMail(): ?string
    {
        return $this->mail;
    }

    // Setter for mail
    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }
}
?>
