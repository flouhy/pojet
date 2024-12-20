<?php
include_once '../CONTROLLER/LivraisonC.php';
include_once '../CONTROLLER/LivreurC.php';
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/SMTP.php';

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$message = "Hello, Console!"; // Your PHP message
echo "<script>console.log('" . addslashes($message) . "');</script>";
$errorMessage = "";
$successMessage = "";

// Create instances of controllers
$livraisonC = new LivraisonC();
$livreurC = new LivreurC();

// Fetch emails of delivery personnel
$emails = $livreurC->getAllMails();
$message = "Hello, Consolezz!"; // Your PHP message
echo "<script>console.log('" . addslashes($message) . "');</script>";
// Check if the form was submitted
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
    $message = "Hello, Consolefinal!"; // Your PHP message
echo "<script>console.log('" . addslashes($message) . "');</script>";

    try {
        $message = "Hello, Console2!"; // Your PHP message
echo "<script>console.log('" . addslashes($message) . "');</script>";
        // Add delivery to the database
        $livraisonC->ajouterLivraison($livraison);

        // Send confirmation email
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Correct SMTP host for Gmail
            $mail->SMTPAuth = true;
            $mail->Username = 'xxxkhaled@gmail.com'; // Your Gmail address
            $mail->Password = 'xXxkhaled123'; // Your Gmail app password (not your Gmail login password)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('xxxkhaled@gmail.com', 'B-Tohfa');
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
            $message = "Hello, Console3!"; // Your PHP message
echo "<script>console.log('" . addslashes($message) . "');</script>";
            $errorMessage = "Livraison ajoutée, mais impossible d'envoyer l'email. Erreur: {$mail->ErrorInfo}";
        }
    } catch (Exception $e) {
        $message = "Hello, Console4!"; // Your PHP message
echo "<script>console.log('" . addslashes($message) . "');</script>";
        $errorMessage = "Erreur lors de l'ajout de la livraison : " . $e->getMessage();
    }
}
?>
