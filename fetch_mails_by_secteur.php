<?php
include_once '../CONTROLLER/LivreurC.php';

// Create an instance of the LivreurC controller
$livreurC = new LivreurC();

// Get the secteur from the POST request
if (isset($_POST['secteur'])) {
    $secteur = $_POST['secteur'];

    // Fetch emails of livreurs with the given secteur
    $emails = $livreurC->getMailBySecteur($secteur);

    // Check if there are emails for the given secteur
    if ($emails) {
        foreach ($emails as $email) {
            echo "<option value='$email'>$email</option>";
        }
    } else {
        echo "<option value=''>Aucun livreur trouvé pour ce secteur</option>";
    }
}
?>
