<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Adresse de réception
    $to = "gleaming.blades.1@gmail.com";

    // Sujet de l'email
    $subject = "Nouvelle candidature pour Chaos Core";

    // Récupérer les données du formulaire
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $category = htmlspecialchars($_POST['category']);
    $message = htmlspecialchars($_POST['message']);

    // Construire le contenu de l'email
    $emailContent = "Nom : $name\n";
    $emailContent .= "Email : $email\n";
    $emailContent .= "Catégorie : $category\n\n";
    $emailContent .= "Message :\n$message\n";

    // En-têtes de l'email
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Envoyer l'email
    if (mail($to, $subject, $emailContent, $headers)) {
        echo "Votre candidature a été envoyée avec succès ! Merci.";
    } else {
        echo "Erreur lors de l'envoi. Veuillez réessayer.";
    }
} else {
    echo "Méthode non autorisée.";
}
?>
