<?php
// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
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

    // Définir l'email de destination
    $to = "votre-email@example.com"; // Remplacez par l'email du staff

    // En-têtes de l'email
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Envoyer l'email
    if (mail($to, $subject, $message, $headers)) {
        // Redirection vers la page précédente
        echo "<script>
                alert('Votre message a été envoyé au staff.');
                window.history.back();
              </script>";
    } else {
        echo "Une erreur est survenue lors de l'envoi de l'email.";
    }
}
?>
