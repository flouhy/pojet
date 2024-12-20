<?php 
include '../CONTROLLER/livreurC.php';
$LivreurC = new LivreurC();
$list = $LivreurC->afficherLivreur();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>B-Tohfa - Gestion des Livreurs</title>
    <!-- Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Topbar -->
    <div class="container-fluid bg-primary text-white py-2">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h3 class="mb-0"><span class="text-white">B-</span>Tohfa</h3>
            </div>
            <div class="col-lg-6 text-end">
                <a class="btn btn-light btn-sm rounded-circle" href="#"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-light btn-sm rounded-circle" href="#"><i class="fab fa-facebook"></i></a>
                <a class="btn btn-light btn-sm rounded-circle" href="#"><i class="fab fa-linkedin"></i></a>
                <a class="btn btn-light btn-sm rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
        <div class="container">
            <a href="index.html" class="navbar-brand">B-Tohfa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="index.html" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="service.html" class="nav-link">Services</a></li>
                    <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="container-fluid bg-primary text-white py-5 mb-4 text-center">
        <h1 class="display-3">Liste des Livreurs</h1>
    </div>

    <!-- Table des Livreurs -->
    <div class="container">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Secteur</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($list) {
                        foreach ($list as $Livreur) {
                            echo "<tr>";
                            echo "<td>" . $Livreur['id_livreur'] . "</td>";
                            echo "<td>" . $Livreur['Nom_livreur'] . "</td>";
                            echo "<td>" . $Livreur['Prenom_Livreur'] . "</td>";
                            echo "<td>" . $Livreur['Secteur'] . "</td>";
                            echo "<td>" . $Livreur['mail'] . "</td>";
                            echo '<td>
                                    <a class="btn btn-primary btn-sm" href="updatelivreur.php?id_livreur=' . $Livreur['id_livreur'] . '">Modifier</a>
                                    <a class="btn btn-danger btn-sm" href="deletelivreur.php?id_livreur=' . $Livreur['id_livreur'] . '">Supprimer</a>
                                  </td>';
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- Boutons sous la table -->
        <div class="text-end my-3">
            <a href="addlivreur.php" class="btn btn-success">Ajouter un livreur</a>
            <a href="indexlivraison.php" class="btn btn-primary ms-2">Voir les Livraisons</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-primary text-white text-center py-3">
        <p class="mb-0">&copy; 2024 B-Tohfa. Tous droits réservés.</p>
    </footer>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
