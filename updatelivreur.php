<?php
include_once '../CONTROLLER/LivreurC.php';
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$errorMessage = "";
$successMessage = "";

// Controllers
$livreurC = new LivreurC();
$livreur = null;

// Fetch the existing Livreur data
if (isset($_GET['id'])) {
    $livreur = $livreurC->getLivreurById($_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $secteur = $_POST['secteur'];
    $mail = $_POST['mail'];

    try {
        // Update Livreur data
        $livreurUpdated = new Livreur($nom, $prenom, $secteur, $mail);
        $livreurC->updateLivreur($id, $livreurUpdated);

        // Email Notification
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mejriftouuh@gmail.com';
        $mail->Password = 'zopb jrjv pbfl fcsc';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('mejriftouuh@gmail.com', 'B-Tohfa');
        $mail->addAddress($mail);  // Send to updated email
        $mail->isHTML(true);
        $mail->Subject = 'Mise à jour du Livreur';
        $mail->Body = "
            <h3>Le Livreur a été mis à jour</h3>
            <p>Les informations du livreur ont été mises à jour :</p>
            <ul>
                <li><b>Nom :</b> $nom</li>
                <li><b>Prénom :</b> $prenom</li>
                <li><b>Secteur :</b> $secteur</li>
                <li><b>Email :</b> $mail</li>
            </ul>
        ";
        $mail->send();

        $successMessage = "Livreur mis à jour avec succès ! Un email a été envoyé.";
    } catch (Exception $e) {
        $errorMessage = "Erreur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>B-Tohfa - Mettre à jour Livreur</title>
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
            <h2 class="display-5">Mettre à jour un Livreur</h2>
            <p class="lead">Mettez à jour les informations d'un livreur existant.</p>
        </div>
    </section>

    <!-- Form Section -->
    <div class="container my-5">
        <?php if ($errorMessage): ?>
            <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
        <?php elseif ($successMessage): ?>
            <div class="alert alert-success"><?php echo $successMessage; ?></div>
        <?php endif; ?>

        <form method="post" class="form" onsubmit="return validateForm()">
            <!-- Nom -->
            <div class="mb-3 row">
                <label for="nom" class="col-sm-3 col-form-label">Nom</label>
                <div class="col-sm-6">
                    <input type="text" name="nom" id="nom" class="form-control" value="<?php echo $livreur ? $livreur['Nom_livreur'] : ''; ?>" required>
                </div>
            </div>
            <!-- Prénom -->
            <div class="mb-3 row">
                <label for="prenom" class="col-sm-3 col-form-label">Prénom</label>
                <div class="col-sm-6">
                    <input type="text" name="prenom" id="prenom" class="form-control" value="<?php echo $livreur ? $livreur['Prenom_Livreur'] : ''; ?>" required>
                </div>
            </div>
            <!-- Secteur -->
            <div class="mb-3 row">
                <label for="secteur" class="col-sm-3 col-form-label">Secteur</label>
                <div class="col-sm-6">
                    <input type="text" name="secteur" id="secteur" class="form-control" value="<?php echo $livreur ? $livreur['Secteur'] : ''; ?>" required>
                </div>
            </div>
            <!-- Email -->
            <div class="mb-3 row">
                <label for="mail" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" name="mail" id="mail" class="form-control" value="<?php echo $livreur ? $livreur['Mail'] : ''; ?>" required>
                </div>
            </div>
            <!-- Submit -->
            <div class="row mb-5">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a href="indexlivreur.php" class="btn btn-secondary">Annuler</a>
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
</body>
</html>
