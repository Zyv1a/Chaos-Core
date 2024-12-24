<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "gleaming.blades.1@gmail.com"; // Adresse e-mail de destination
    $subject = "Nouvelle candidature - Chaos Core";

    // Récupération des données du formulaire
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $category = htmlspecialchars($_POST['category']);
    $messageContent = "Nom : $name\nEmail : $email\nCatégorie : $category\n";

    // Ajouter les questions supplémentaires selon la catégorie
    foreach ($_POST as $key => $value) {
        if (!in_array($key, ['name', 'email', 'category'])) {
            $messageContent .= ucfirst($key) . " : " . htmlspecialchars($value) . "\n";
        }
    }

    // En-têtes de l'email
    $headers = "From: no-reply@chaoscore.com\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Envoi de l'e-mail
    if (mail($to, $subject, $messageContent, $headers)) {
        echo "Votre candidature a été envoyée avec succès !";
    } else {
        echo "Erreur : votre candidature n'a pas pu être envoyée.";
    }
} else {
    echo "Méthode non autorisée.";
}
?>
