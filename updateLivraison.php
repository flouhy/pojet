<?php
include '../CONTROLLER/LivraisonC.php';

$error = "";
$livraisonC = new LivraisonC();
$livraison = null;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET["id"]) && !empty($_GET["id"])) {
        $livraisonID = $_GET["id"];
        $livraison = $livraisonC->getLivraisonById($livraisonID);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST["id"]) &&
        isset($_POST["Nom"]) &&
        isset($_POST["Adresse"]) &&
        isset($_POST["Ville"]) &&
        isset($_POST["Code_postale"]) &&
        isset($_POST["Telephone"]) &&
        isset($_POST["Date_l"]) &&
        isset($_POST["Mail_livreur"])
    ) {
        if (
            !empty($_POST["id"]) &&
            !empty($_POST['Nom']) &&
            !empty($_POST['Adresse']) &&
            !empty($_POST['Ville']) &&
            !empty($_POST['Code_postale']) &&
            !empty($_POST['Telephone']) &&
            !empty($_POST['Date_l']) &&
            !empty($_POST['Mail_livreur'])
        ) {
            $id = $_POST["id"];
            $nom = $_POST['Nom'];
            $adresse = $_POST['Adresse'];
            $ville = $_POST['Ville'];
            $code_postale = $_POST['Code_postale'];
            $telephone = $_POST['Telephone'];
            $date_l = $_POST['Date_l'];
            $mail_livreur = $_POST['Mail_livreur'];

            $livraisonC->modifierLivraison($id, $nom, $adresse, $ville, $code_postale, $telephone, $date_l, $mail_livreur);
            header('Location: indexlivraison.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Livraison</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script>
        function validateForm() {
            var nom = document.getElementById("Nom").value;
            var ville = document.getElementById("Ville").value;

            if (nom.length <= 2 || ville.length <= 2) {
                alert("Le nom et la ville doivent contenir plus de 2 caractères.");
                return false;
            }

            var firstCharNom = nom.charAt(0);
            var firstCharVille = ville.charAt(0);
            if (firstCharNom !== firstCharNom.toUpperCase() || firstCharVille !== firstCharVille.toUpperCase()) {
                alert("Le nom et la ville doivent commencer par une lettre majuscule.");
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
            <h2 class="display-5">Modifier Livraison</h2>
            <p class="lead">Mettez à jour les informations de votre livraison.</p>
        </div>
    </section>

    <!-- Form Section -->
    <div class="container my-5">
        <form method="POST" class="form" onsubmit="return validateForm()">
            <input type="hidden" name="id" value="<?php echo $livraison['id']; ?>">
            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Nom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Nom" id="Nom" value="<?php echo $livraison['nom']; ?>" placeholder="Nom Livraison">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Adresse</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Adresse" value="<?php echo $livraison['adresse']; ?>" placeholder="Adresse">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Ville</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Ville" id="Ville" value="<?php echo $livraison['ville']; ?>" placeholder="Ville">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Code Postal</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Code_postale" value="<?php echo $livraison['code_postale']; ?>" placeholder="Code Postal">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Téléphone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Telephone" value="<?php echo $livraison['telephone']; ?>" placeholder="Téléphone">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Date Livraison</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="Date_l" value="<?php echo $livraison['DATE_L']; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Email Livreur</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="Mail_livreur" value="<?php echo $livraison['mail_livreur']; ?>" placeholder="Email Livreur">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3 offset-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a href="indexlivraison.php" class="btn btn-secondary">Quitter</a>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
