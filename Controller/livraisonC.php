<?php 
include '../MODEL/Livraison.php';
include '../Config.php';

class LivraisonC
{
    // Récupère une livraison par son ID
    function getLivraisonById($id)
    {
        $sql = "SELECT * FROM livraison WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();

            $livraison = $query->fetch();
            return $livraison;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Récupère une livraison par sa date
    function getLivraisonByDate($date_l)
    {
        $sql = "SELECT * FROM livraison WHERE date_l = :date_l";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':date_l', $date_l, PDO::PARAM_STR);
            $query->execute();

            $livraison = $query->fetch();
            return $livraison;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Ajouter une nouvelle livraison
    function ajouterLivraison($livraison)
    {
        $sql = "INSERT INTO livraison (nom, adresse, ville, code_postale, telephone, date_l, mail_livreur)
                VALUES (:nom, :adresse, :ville, :code_postale, :telephone, :date_l, :mail_livreur)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $livraison->getNom(),
                'adresse' => $livraison->getAdresse(),
                'ville' => $livraison->getVille(),
                'code_postale' => $livraison->getCodePostale(),
                'telephone' => $livraison->getTelephone(),
                'date_l' => $livraison->getDateL(),
                'mail_livreur' => $livraison->getMailLivreur()  // Ajouter mail_livreur
            ]);
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    // Afficher toutes les livraisons
    public function afficherLivraison()
    {
        $sql = "SELECT * FROM livraison";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste->fetchAll();  // Utiliser fetchAll pour récupérer les résultats sous forme de tableau
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Supprimer une livraison par son ID
    function supprimerLivraison($id)
    {
        $sql = "DELETE FROM livraison WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id, PDO::PARAM_INT);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Modifier une livraison existante
    function modifierLivraison($id, $nom, $adresse, $ville, $code_postale, $telephone, $date_l, $mail_livreur)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE livraison 
                SET nom = :nom, adresse = :adresse, ville = :ville, 
                    code_postale = :code_postale, telephone = :telephone, date_l = :date_l, mail_livreur = :mail_livreur
                WHERE id = :id'
            );
            $query->bindValue(':nom', $nom, PDO::PARAM_STR);
            $query->bindValue(':adresse', $adresse, PDO::PARAM_STR);
            $query->bindValue(':ville', $ville, PDO::PARAM_STR);
            $query->bindValue(':code_postale', $code_postale, PDO::PARAM_INT);
            $query->bindValue(':telephone', $telephone, PDO::PARAM_INT);
            $query->bindValue(':date_l', $date_l, PDO::PARAM_STR);
            $query->bindValue(':mail_livreur', $mail_livreur, PDO::PARAM_STR);
            $query->bindValue(':id', $id, PDO::PARAM_INT);

            $query->execute();
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
}
?>
