<?php
include_once '../CONTROLLER/LivraisonC.php';
include_once '../CONTROLLER/LivreurC.php';
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/SMTP.php';

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$errorMessage = "";
$successMessage = "";

// Create instances of controllers
$livraisonC = new LivraisonC();
$livreurC = new LivreurC();

// Retrieve emails of the deliverers
$emails = $livreurC->getAllMails();

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];
    $ville = $_POST['ville'];
    $code_postale = $_POST['code_postale'];
    $telephone = $_POST['telephone'];
    $date_livraison = $_POST['date_livraison'];
    $mail_livreur = $_POST['mail_livreur'];

    // Create a Livraison object
    $livraison = new Livraison($nom, $adresse, $ville, $code_postale, $telephone, $date_livraison, $mail_livreur);

    try {
        $livraisonC->ajouterLivraison($livraison);

        // Send confirmation email
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Correct SMTP host for Gmail
            $mail->SMTPAuth = true;
            $mail->Username = 'mejriftouuh@gmail.com'; // Your Gmail address
            $mail->Password = 'zopb jrjv pbfl fcsc'; // Your Gmail app password (not your Gmail login password)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('mejriftouuh@gmail.com', 'B-Tohfa');
            $mail->addAddress($mail_livreur); // Selected delivery person's email

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Confirmation de livraison';
            $mail->Body = "
                <h3>Confirmation de Livraison</h3>
                <p>Bonjour,</p>
                <p>Une nouvelle livraison a été assignée à votre compte :</p>
                <ul>
                    <li><b>Nom :</b> $nom</li>
                    <li><b>Adresse :</b> $adresse</li>
                    <li><b>Ville :</b> $ville</li>
                    <li><b>Code Postal :</b> $code_postale</li>
                    <li><b>Téléphone :</b> $telephone</li>
                    <li><b>Date de Livraison :</b> $date_livraison</li>
                </ul>
                <p>Merci de confirmer la réception de cette tâche.</p>
            ";
            $mail->AltBody = "Une nouvelle livraison a été assignée à votre compte. Détails: Nom: $nom, Adresse: $adresse, Ville: $ville, Code Postal: $code_postale, Téléphone: $telephone, Date Livraison: $date_livraison.";

            $mail->send();
            $successMessage = "Livraison ajoutée avec succès ! Un email de confirmation a été envoyé.";
        } catch (Exception $e) {
            $errorMessage = "Livraison ajoutée, mais impossible d'envoyer l'email. Erreur: {$mail->ErrorInfo}";
        }
    } catch (Exception $e) {
        $errorMessage = "Erreur lors de l'ajout de la livraison : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>B-Tohfa - Ajouter Livraison</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script>
        // Function to fetch emails by sector
        function getMailsBySecteur(secteur) {
            if (secteur) {
                $.ajax({
                    url: 'fetch_mails_by_secteur.php', // PHP file to fetch emails
                    type: 'POST',
                    data: { secteur: secteur },
                    success: function(data) {
                        $('#mail_livreur').html(data); // Update the mail dropdown
                    }
                });
            }
        }

        // Validate the form to ensure all fields are filled
        function validateForm() {
            var nom = document.getElementById("nom").value;
            var adresse = document.getElementById("adresse").value;
            var ville = document.getElementById("ville").value;
            var code_postale = document.getElementById("code_postale").value;
            var telephone = document.getElementById("telephone").value;
            var date_livraison = document.getElementById("date_livraison").value;
            var mail_livreur = document.getElementById("mail_livreur").value;

            // If any of the fields are empty, alert and prevent submission
            if (nom.trim() === "" || adresse.trim() === "" || ville.trim() === "" || code_postale.trim() === "" || telephone.trim() === "" || date_livraison.trim() === "") {
                alert("Tous les champs sont obligatoires.");
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
            <h2 class="display-5">Ajouter une Livraison</h2>
            <p class="lead">Ajoutez une nouvelle livraison avec les informations nécessaires.</p>
        </div>
    </section>

    <!-- Form Section -->
    <div class="container my-5">
        <?php if ($errorMessage): ?>
            <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
        <?php elseif ($successMessage): ?>
            <div class="alert alert-success"><?php echo $successMessage; ?></div>
        <?php endif; ?>

        <form method="post" class="form" name="form" id="form" enctype="multipart/form-data" onsubmit="return validateForm()">
            <!-- Nom -->
            <div class="input-group mb-3">
                <label class="col-sm-3 col-form-label">Nom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" value="<?php echo isset($_POST['nom']) ? $_POST['nom'] : ''; ?>">
                </div>
            </div>

            <!-- Adresse -->
            <div class="input-group mb-3">
                <label class="col-sm-3 col-form-label">Adresse</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Adresse" value="<?php echo isset($_POST['adresse']) ? $_POST['adresse'] : ''; ?>">
                </div>
            </div>

            <!-- Ville -->
            <div class="input-group mb-3">
                <label class="col-sm-3 col-form-label">Ville</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="ville" id="ville" placeholder="Ville" value="<?php echo isset($_POST['ville']) ? $_POST['ville'] : ''; ?>">
                </div>
            </div>

            <!-- Téléphone -->
            <div class="input-group mb-3">
                <label class="col-sm-3 col-form-label">Téléphone</label>
                <div class="col-sm-6">
                    <input type="tel" class="form-control" name="telephone" id="telephone" placeholder="Téléphone" value="<?php echo isset($_POST['telephone']) ? $_POST['telephone'] : ''; ?>">
                </div>
            </div>

            <!-- Date Livraison -->
            <div class="input-group mb-3">
                <label class="col-sm-3 col-form-label">Date Livraison</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="date_livraison" id="date_livraison" value="<?php echo isset($_POST['date_livraison']) ? $_POST['date_livraison'] : ''; ?>">
                </div>
            </div>

            <!-- Secteur (Trigger for Mail Dropdown) -->
            <div class="input-group mb-3">
                <label class="col-sm-3 col-form-label">Secteur</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="secteur" id="secteur" placeholder="Secteur" onchange="getMailsBySecteur(this.value)" value="<?php echo isset($_POST['secteur']) ? $_POST['secteur'] : ''; ?>">
                </div>
            </div>

            <!-- Dropdown for mail_livreur -->
            <div class="input-group mb-3">
                <label class="col-sm-3 col-form-label">Mail du Livreur</label>
                <div class="col-sm-6">
                    <select class="form-control" name="mail_livreur" id="mail_livreur">
                        <option value="">Sélectionner un email</option>
                        <?php
                        // Display emails of deliverers
                        foreach ($emails as $email) {
                            echo "<option value='$email'>$email</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="row mb-5">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary" name="Ajouter" id="Ajouter">Ajouter</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-secondary" href="indexlivraison.php" role="button">Quitter</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2024 B-Tohfa. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
