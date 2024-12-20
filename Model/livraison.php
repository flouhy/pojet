<?php
class Livraison
{
    private ?int $id = null;
    private ?string $nom = null;
    private ?string $adresse = null;
    private ?string $ville = null;
    private ?int $code_postale = null;
    private ?int $telephone = null;
    private ?string $date_l = null;
    private ?string $mail_livreur = null;  // Added mail_livreur property

    // Constructor with parameters
    public function __construct(
        string $nom, 
        string $adresse, 
        string $ville, 
        int $code_postale, 
        int $telephone, 
        string $date_l, 
        ?string $mail_livreur = null,  // Added mail_livreur to constructor
        ?int $id = null
    )
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->ville = $ville;
        $this->code_postale = $code_postale;
        $this->telephone = $telephone;
        $this->date_l = $date_l;
        $this->mail_livreur = $mail_livreur;  // Initialize mail_livreur
    }

    // Getter for id
    public function getId(): ?int
    {
        return $this->id;
    }

    // Getter for nom
    public function getNom(): ?string
    {
        return $this->nom;
    }

    // Setter for nom
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    // Getter for adresse
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    // Setter for adresse
    public function setAdresse(string $adresse): void
    {
        $this->adresse = $adresse;
    }

    // Getter for ville
    public function getVille(): ?string
    {
        return $this->ville;
    }

    // Setter for ville
    public function setVille(string $ville): void
    {
        $this->ville = $ville;
    }

    // Getter for code_postale
    public function getCodePostale(): ?int
    {
        return $this->code_postale;
    }

    // Setter for code_postale
    public function setCodePostale(int $code_postale): void
    {
        $this->code_postale = $code_postale;
    }

    // Getter for telephone
    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    // Setter for telephone
    public function setTelephone(int $telephone): void
    {
        $this->telephone = $telephone;
    }

    // Getter for date_l
    public function getDateL(): ?string
    {
        return $this->date_l;
    }

    // Setter for date_l
    public function setDateL(string $date_l): void
    {
        $this->date_l = $date_l;
    }

    // Getter for mail_livreur
    public function getMailLivreur(): ?string
    {
        return $this->mail_livreur;
    }

    // Setter for mail_livreur
    public function setMailLivreur(string $mail_livreur): void
    {
        $this->mail_livreur = $mail_livreur;
    }
}
?>
