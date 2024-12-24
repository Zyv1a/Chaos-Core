<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Adresse e-mail de destination
    $to = "gleaming.blades.1@gmail.com";

    // Sujet de l'e-mail
    $subject = "Nouvelle candidature pour Chaos Core";

    // Contenu de l'e-mail
    $message = "Vous avez reçu une nouvelle candidature :\n\n";
    foreach ($_POST as $key => $value) {
        $message .= ucfirst($key) . ": " . htmlspecialchars($value) . "\n";
    }

    // En-têtes de l'e-mail
    $headers = "From: no-reply@chaoscore.com\r\n";
    $headers .= "Reply-To: no-reply@chaoscore.com\r\n";

    // Envoi de l'e-mail
    if (mail($to, $subject, $message, $headers)) {
        echo "Votre formulaire a été envoyé avec succès !";
    } else {
        echo "Une erreur est survenue lors de l'envoi du formulaire. Veuillez réessayer.";
    }
} else {
    echo "Méthode non autorisée.";
}
?>
