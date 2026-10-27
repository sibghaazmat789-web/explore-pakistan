<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once __DIR__ . '/../PHPMailer/Exception.php';
require_once __DIR__ . '/../PHPMailer/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer/SMTP.php';
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['send'])) {
    header('Location: ../index.php#contact');
    exit();
}

$full_name = trim($_POST['full_name'] ?? '');
$email     = trim($_POST['email'] ?? '');
$subject   = trim($_POST['subject'] ?? '');
$message   = trim($_POST['message'] ?? '');

if (
    $full_name === '' ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    $subject === '' ||
    $message === ''
) {
    header('Location: ../index.php?status=invalid#contact');
    exit();
}

// 1. Save the contact message in the database.
try {
    $stmt = $conn->prepare(
        "INSERT INTO contacts (full_name, email, subject, message)
         VALUES (?, ?, ?, ?)"
    );

    $stmt->bind_param('ssss', $full_name, $email, $subject, $message);
    $stmt->execute();
    $stmt->close();
} catch (Throwable $e) {
    error_log('Contact database error: ' . $e->getMessage());
    http_response_code(500);
    exit('Your message could not be saved. Please try again later.');
}

// 2. Email the administrator after saving the message.
try {
    $configPath = __DIR__ . '/../private-config/tourism-config.php';

    if (!is_file($configPath)) {
        throw new RuntimeException('Email configuration file not found.');
    }

    $config = require $configPath;

    if (
        !is_array($config) ||
        empty($config['smtp_user']) ||
        empty($config['smtp_pass']) ||
        empty($config['admin_email'])
    ) {
        throw new RuntimeException('Email configuration is incomplete.');
    }

    $safeName = htmlspecialchars($full_name, ENT_QUOTES, 'UTF-8');
    $safeEmail = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $safeSubject = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
    $safeMessage = nl2br(
        htmlspecialchars($message, ENT_QUOTES, 'UTF-8')
    );

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $config['smtp_user'];
    $mail->Password = $config['smtp_pass'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->Timeout = 20;
    $mail->CharSet = 'UTF-8';

    $mail->setFrom($config['smtp_user'], 'Explore Pakistan');
    $mail->addAddress($config['admin_email']);
    $mail->addReplyTo($email, $full_name);
    $mail->isHTML(true);
    $mail->Subject = 'New Contact Form Submission';

    $mail->Body = "
        <h2>New Contact Form Submission</h2>
        <p><strong>Name:</strong> {$safeName}</p>
        <p><strong>Email:</strong> {$safeEmail}</p>
        <p><strong>Subject:</strong> {$safeSubject}</p>
        <p><strong>Message:</strong><br>{$safeMessage}</p>
    ";

    $mail->AltBody =
        "New Contact Form Submission\n" .
        "Name: {$full_name}\nEmail: {$email}\n" .
        "Subject: {$subject}\nMessage: {$message}";

    $mail->send();
} catch (Throwable $e) {
    error_log('Contact email error: ' . $e->getMessage());
}

// 3. Return to the contact form even if email delivery fails.
header('Location: ../index.php?status=success#contact');
exit();
