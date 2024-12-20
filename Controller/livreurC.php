<?php 
include '../MODEL/Livreur.php';
//include '../Controller/livraisonC.php';
include_once '../config.php';

class LivreurC
{
    function getLivreurById($id_livreur){
        $sql = "SELECT * from livreur where id_livreur = :id_livreur";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id_livreur', $id_livreur, PDO::PARAM_INT);
            $query->execute();

            $livreur = $query->fetch();
            return $livreur;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    function getLivreurByNom($Nom_livreur){
        $sql = "SELECT * from livreur where Nom_livreur = :Nom_livreur";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':Nom_livreur', $Nom_livreur, PDO::PARAM_STR);
            $query->execute();

            $livreur = $query->fetch();
            return $livreur;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    function ajouterLivreur($livreur)
    {
        $sql = "INSERT INTO livreur (Nom_livreur, Prenom_Livreur, Secteur, mail)
        VALUES (:Nom_livreur, :Prenom_Livreur, :Secteur, :mail)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'Nom_livreur' => $livreur->getNomLivreur(),
                'Prenom_Livreur' => $livreur->getPrenomLivreur(),
                'Secteur' => $livreur->getSecteur(),
                'mail' => $livreur->getMail(),  // Added mail_livreur
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function afficherLivreur()
    {
        $sql = "SELECT * FROM livreur";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    public function getMailBySecteur(int $secteur)
{
    $sql = "SELECT mail FROM livreur WHERE Secteur = :secteur";  // Adjusted SQL query to filter by Secteur
    $db = config::getConnexion();
    
    try {
        $stmt = $db->prepare($sql);  // Prepare the SQL statement
        $stmt->bindParam(':secteur', $secteur, PDO::PARAM_STR);  // Bind the secteur parameter to prevent SQL injection
        $stmt->execute();  // Execute the query

        // Fetch all emails of livreurs with the specified secteur
        $mails = $stmt->fetchAll(PDO::FETCH_COLUMN);  
        return $mails;  // Return the array of emails

    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());  // Handle any errors
    }
}



      public function getAllMails()
    {
        $sql = "SELECT mail FROM livreur";
        $db = config::getConnexion();
        try {
            $query = $db->query($sql);
            $mails = $query->fetchAll(PDO::FETCH_COLUMN);
            return $mails;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function supprimerLivreur($id_livreur)
    {
        $sql = "DELETE FROM livreur WHERE id_livreur = :id_livreur";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_livreur', $id_livreur, PDO::PARAM_INT);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function modifierLivreur($id_livreur, $Nom_livreur, $Prenom_Livreur, $Secteur, $mail)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE livreur 
                 SET Nom_livreur = :Nom_livreur, Prenom_Livreur = :Prenom_Livreur, Secteur = :Secteur, mail = :mail
                 WHERE id_livreur = :id_livreur'
            );
            $query->bindValue(':Nom_livreur', $Nom_livreur, PDO::PARAM_STR);
            $query->bindValue(':Prenom_Livreur', $Prenom_Livreur, PDO::PARAM_STR);
            $query->bindValue(':Secteur', $Secteur, PDO::PARAM_STR);
            $query->bindValue(':mail', $mail, PDO::PARAM_STR);  // Updated for mail_livreur
            $query->bindValue(':id_livreur', $id_livreur, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
}
?>
