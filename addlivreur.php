<?php
include_once '../CONTROLLER/LivreurC.php';

$errorMessage = "";
$successMessage = "";

// Create a Livreur instance
$livreur = null;

// Create an instance of the controller
$livreurC = new LivreurC();
if (
    isset($_POST["Nom_livreur"]) &&
    isset($_POST["Prenom_Livreur"]) &&
    isset($_POST["Secteur"]) &&
    isset($_POST["Mail"])
) {
    if (
        !empty($_POST["Nom_livreur"]) &&
        !empty($_POST["Prenom_Livreur"]) &&
        !empty($_POST["Secteur"]) &&
        !empty($_POST["Mail"])
    ) {
        $livreur = new Livreur(
            $_POST['Nom_livreur'],
            $_POST['Prenom_Livreur'],
            $_POST['Secteur'],
            $_POST['Mail']  // Add mail field
        );
        $livreurC->ajouterLivreur($livreur);
        header("Location:indexlivreur.php?successMessage=Livreur ajouté avec succès");
    } else {
        $errorMessage = "<label id='form' style='color: red; font-weight: bold;'>&emsp;Une Information manquante !</label>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>B-Tohfa - Ajouter Livreur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script>
        function validateForm() {
            var Nom_livreur = document.getElementById("Nom_livreur").value;
            var Prenom_Livreur = document.getElementById("Prenom_Livreur").value;
            var Secteur = document.getElementById("Secteur").value;
            var Mail = document.getElementById("Mail").value;

            if (Nom_livreur.trim() === "" || Prenom_Livreur.trim() === "" || Secteur.trim() === "" || Mail.trim() === "") {
                alert("Tous les champs sont obligatoires.");
                return false;
            }

            if (Nom_livreur.length <= 3 || Prenom_Livreur.length <= 3) {
                alert("Le nom et le prénom doivent contenir plus de 3 caractères.");
                return false;
            }

            var firstCharNom = Nom_livreur.charAt(0);
            var firstCharPrenom = Prenom_Livreur.charAt(0);
            if (firstCharNom !== firstCharNom.toUpperCase() || firstCharPrenom !== firstCharPrenom.toUpperCase()) {
                alert("Le nom et le prénom doivent commencer par une lettre majuscule.");
                return false;
            }

            var mailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if (!mailPattern.test(Mail)) {
                alert("Veuillez entrer une adresse e-mail valide.");
                return false;
            }

            return true;
        }
    </script>
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
            <h2 class="display-5">Ajouter un Nouveau Livreur</h2>
            <p class="lead">Ajoutez un nouveau livreur avec les informations nécessaires.</p>
        </div>
    </section>

    <!-- Form Section -->
    <div class="container my-5">
        <?php if ($errorMessage): ?>
            <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <form method="post" class="form" name="form" id="form" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="input-group mb-3">
                <label class="col-sm-3 col-form-label">Nom Livreur</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Nom_livreur" id="Nom_livreur" placeholder="Nom Livreur">
                </div>
            </div>

            <div class="input-group mb-3">
                <label class="col-sm-3 col-form-label">Prénom Livreur</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Prenom_Livreur" id="Prenom_Livreur" placeholder="Prénom Livreur">
                </div>
            </div>

            <div class="input-group mb-3">
                <label class="col-sm-3 col-form-label">Secteur</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Secteur" id="Secteur" placeholder="Secteur">
                </div>
            </div>

            <div class="input-group mb-3">
                <label class="col-sm-3 col-form-label">Mail</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="Mail" id="Mail" placeholder="Email Livreur">
                </div>
            </div>

            <div class="row mb-5">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary" name="Ajouter" id="Ajouter">Ajouter</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-secondary py-md-3 px-md-5" href="indexlivreur.php" role="button">Quitter</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <footer class="bg-primary text-white py-4">
        <div class="container text-center">
            <p class="m-0">&copy; 2024 B-Tohfa. Tous droits réservés.</p>
        </div>
    </footer>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
