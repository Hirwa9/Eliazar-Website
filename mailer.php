<?php
use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';

// Load .env file
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Mailer function
function sendMail($recipient, $subject, $body)
{
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();                                    // Set mailer to use SMTP
        $mail->Host = $_ENV['MAIL_HOST'];                   // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                             // Enable SMTP authentication
        $mail->Username = $_ENV['MAIL_USERNAME'];           // SMTP username
        $mail->Password = $_ENV['MAIL_PASSWORD'];           // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port = $_ENV['MAIL_PORT'];                   // SMTP port

        // // Server settings
        // $mail->isSMTP();                                    // Set mailer to use SMTP
        // $mail->Host = 'mail.eliazarndayisabye.c1.is';       // Specify main and backup SMTP servers
        // $mail->SMTPAuth = true;                             // Enable SMTP authentication
        // $mail->Username = 'admin@eliazarndayisabye.c1.is';  // SMTP username
        // $mail->Password = 'Vansdoor.135';                   // SMTP password
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` also accepted
        // $mail->Port = 587;                                   // SMTP port

        // Email settings
        $mail->setFrom('easternsngersg@example.com', 'Your website blog');
        $mail->addAddress($recipient);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        // Send the email
        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        return false;
    }
}