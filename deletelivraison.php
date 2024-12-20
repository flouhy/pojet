<?php

    include '../CONTROLLER/livraisonC.php';


    $message = "";


    $livraisonC = new LivraisonC();


    if (isset($_GET["id"])) {

        $livraisonC->supprimerLivraison($_GET["id"]);


        header('Location:indexLivraison.php?message=Livraison Supprimée avec succès');
    } else {

        $message = "Erreur: ID de la livraison manquant";
        echo $message;
    }
?>
