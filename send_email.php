<?php
// Vérification que le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $form_type = htmlspecialchars($_POST['form_type']);
    $email = htmlspecialchars($_POST['email']);

    // Créer le sujet et le message en fonction du type de formulaire
    if ($form_type == 'recrutement') {
        $role = htmlspecialchars($_POST['role']);
        $experience = htmlspecialchars($_POST['experience']);
        $subject = "Recrutement - $role";
        $message = "Rôle recherché: $role\nExpérience: $experience\nEmail: $email";
    } elseif ($form_type == 'suggestion_bug') {
        $issue_type = htmlspecialchars($_POST['issue_type']);
        $details = htmlspecialchars($_POST['details']);
        $subject = "$issue_type soumis";
        $message = "$issue_type: $details\nEmail: $email";
    }

    // L'email du destinataire (staff)
    $to = "votre-email@example.com"; // Remplacez par l'adresse email du staff

    // Définir les en-têtes de l'email
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Envoi de l'email
    if (mail($to, $subject, $message, $headers)) {
        // Redirection avec message de confirmation
        echo "<script>
                alert('Votre message a été envoyé au staff.');
                window.history.back();
              </script>";
    } else {
        echo "Une erreur est survenue lors de l'envoi de l'email.";
    }
}
?>
