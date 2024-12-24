<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $category = htmlspecialchars($_POST['category']);
    $question = htmlspecialchars($_POST['question']);
    $email = htmlspecialchars($_POST['email']);

    // Définir l'adresse email où envoyer le formulaire
    $to = "votre-email@example.com"; // Modifiez cette ligne avec l'email souhaité
    $subject = "Nouvelle question de la catégorie: $category";

    // Créer le message
    $message = "
    Catégorie: $category\n
    Question: $question\n
    Email: $email
    ";

    // Définir les en-têtes
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Envoyer l'email
    if (mail($to, $subject, $message, $headers)) {
        echo "Merci de votre soumission. Votre message a été envoyé.";
    } else {
        echo "Une erreur est survenue lors de l'envoi du message.";
    }
}
?>
