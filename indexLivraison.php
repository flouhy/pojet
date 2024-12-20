<?php 
include '../CONTROLLER/livraisonC.php';
$LivraisonC = new LivraisonC();
$list = $LivraisonC->afficherLivraison();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Livraisons</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header -->
    <header class="bg-primary text-white py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="m-0">B-Tohfa</h1>
            <nav>
                <a href="index.html" class="text-white text-decoration-none me-3">Home</a>
                <a href="about.html" class="text-white text-decoration-none me-3">About</a>
                <a href="contact.html" class="text-white text-decoration-none">Contact</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-light py-5">
        <div class="container text-center">
            <h2 class="display-5">Liste des Livraisons</h2>
            <p class="lead">Gérez vos livraisons facilement et efficacement.</p>
        </div>
    </section>

    <!-- Table Section -->
    <div class="container my-5">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Ville</th>
                        <th>Secteur</th>
                        <th>Téléphone</th>
                        <th>Date</th>
                        <th>Email Livreur</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($list) {
                        foreach ($list as $Livraison) {
                            echo "<tr>";
                            echo "<td>{$Livraison['id']}</td>";
                            echo "<td>{$Livraison['nom']}</td>";
                            echo "<td>{$Livraison['adresse']}</td>";
                            echo "<td>{$Livraison['ville']}</td>";
                            echo "<td>{$Livraison['code_postale']}</td>";
                            echo "<td>{$Livraison['telephone']}</td>";
                            echo "<td>{$Livraison['DATE_L']}</td>";
                            echo "<td>{$Livraison['mail_livreur']}</td>";
                            echo "<td>";
                            echo "<a href='updatelivraison.php?id={$Livraison['id']}' class='btn btn-warning btn-sm'>Modifier</a> ";
                            echo "<a href='deletelivraison.php?id={$Livraison['id']}' class='btn btn-danger btn-sm'>Supprimer</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- Boutons Ajouter Livraison et Voir les Livreurs -->
        <div class="text-end my-3">
            <a href="add_livraison.php" class="btn btn-primary">Ajouter une Livraison</a>
            <a href="indexlivreur.php" class="btn btn-success ms-2">Voir les Livreurs</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-primary text-white py-4">
        <div class="container text-center">
            <p class="m-0">&copy; 2024 B-Tohfa. Tous droits réservés.</p>
            <div class="mt-2">
                <a href="#" class="text-white text-decoration-none me-3">Twitter</a>
                <a href="#" class="text-white text-decoration-none me-3">Facebook</a>
                <a href="#" class="text-white text-decoration-none">Instagram</a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
