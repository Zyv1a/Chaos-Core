<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Configuration SMTP (exemple avec Gmail)
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'votre-email@gmail.com'; // Votre email Gmail
    $mail->Password = 'votre-mot-de-passe';   // Votre mot de passe Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Expéditeur et destinataire
    $mail->setFrom('votre-email@gmail.com', 'Nom de l\'expéditeur');
    $mail->addAddress('votre-email@example.com'); // Adresse où recevoir l'email

    // Contenu de l'email
    $mail->isHTML(true);
    $mail->Subject = 'Test PHPMailer';
    $mail->Body    = 'Ceci est un test envoyé avec PHPMailer.';

    $mail->send();
    echo 'Message a été envoyé';
} catch (Exception $e) {
    echo "Le message n'a pas pu être envoyé. Mailer Error: {$mail->ErrorInfo}";
}
?>
