<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_type = htmlspecialchars($_POST['form_type']);
    $email = htmlspecialchars($_POST['email']);

    if ($form_type == 'recrutement') {
        $role = htmlspecialchars($_POST['role']);
        $experience = htmlspecialchars($_POST['experience']);
        $subject = "Recrutement - $role";
        $message = "Rôle recherché: $role\nExperience: $experience\nEmail: $email";
    } elseif ($form_type == 'suggestion_bug') {
        $issue_type = htmlspecialchars($_POST['issue_type']);
        $details = htmlspecialchars($_POST['details']);
        $subject = "$issue_type soumis";
        $message = "$issue_type: $details\nEmail: $email";
    }

    $to = "votre-email@example.com"; // Remplacez par l'email de destination
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo "Merci pour votre soumission. Votre message a été envoyé.";
    } else {
        echo "Une erreur est survenue lors de l'envoi du message.";
    }
}
?>
