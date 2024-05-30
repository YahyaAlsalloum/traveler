<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';

if (empty($_POST['name']) ||  !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(500);
    exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$m_subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));
$destination = strip_tags(htmlspecialchars($_POST['destination']));

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP(); // Send using SMTP
    $mail->SMTPAuth=true;
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587 ;
    
    //Harikagrubu@gmail.com
    //meeraweshah48@gmail.com kcmu mzeb hckb pwje
    $mail->Username = "meeraweshah48@gmail.com";
    $mail->Password = "kcmumzebhckbpwje";
    
    //Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress('Harikagrubu@gmail.com','Harika grubu app'); // Add a recipient
    $mail->addAddress('meeraweshah48@gmail.com','Harika grubu app'); // Add a recipient

    // Content
    $mail->Subject = $m_subject ;
    $mail->Body = "You have received a new message from your website contact form.\n\nHere are the details:\n\nName: $name\n\nEmail: $email\n\nSubject: $m_subject\n\nMessage: $message \n\nDestination: $destination";
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    http_response_code(500);
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
