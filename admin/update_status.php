<?php

use PHPMailer\PHPMailer\PHPMailer;

session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

require_once __DIR__ . '/../php/db.php';
require_once __DIR__ . '/../PHPMailer/Exception.php';
require_once __DIR__ . '/../PHPMailer/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer/SMTP.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$status = $_GET['status'] ?? '';

$allowedStatuses = ['Pending', 'Confirmed', 'Cancelled', 'Completed'];

if (!$id || !in_array($status, $allowedStatuses, true)) {
    header('Location: bookings.php');
    exit();
}

// Update the booking status and retrieve customer details.
try {
    $stmt = $conn->prepare(
        'UPDATE bookings SET status = ? WHERE id = ?'
    );
    $stmt->bind_param('si', $status, $id);
    $stmt->execute();
    $stmt->close();

    $stmt = $conn->prepare(
        'SELECT full_name, email, destination, travel_date
         FROM bookings WHERE id = ?'
    );
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result(
        $fullName,
        $customerEmail,
        $destination,
        $travelDate
    );

    $found = $stmt->fetch();
    $stmt->close();

    if (!$found) {
        header('Location: bookings.php');
        exit();
    }

} catch (Throwable $e) {
    error_log('Booking status update error: ' . $e->getMessage());
    header('Location: bookings.php?status_error=1');
    exit();
}

// Send the status email separately.
try {
    // IMPORTANT: Match this path to your exact folder name.
    $configPath = __DIR__ . '/../private-config/tourism-config.php';

    if (!is_file($configPath)) {
        throw new RuntimeException(
            'Private configuration file not found: ' . $configPath
        );
    }

    $config = require $configPath;

    if (
        !is_array($config) ||
        empty($config['smtp_user']) ||
        empty($config['smtp_pass'])
    ) {
        throw new RuntimeException(
            'Email configuration is incomplete.'
        );
    }

    $safeName = htmlspecialchars(
        $fullName,
        ENT_QUOTES,
        'UTF-8'
    );
    $safeDestination = htmlspecialchars(
        $destination,
        ENT_QUOTES,
        'UTF-8'
    );
    $safeDate = htmlspecialchars(
        $travelDate,
        ENT_QUOTES,
        'UTF-8'
    );

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $config['smtp_user'];
    $mail->Password = $config['smtp_pass'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';

    $mail->setFrom(
        $config['smtp_user'],
        'Explore Pakistan'
    );
    $mail->addAddress($customerEmail);
    $mail->isHTML(true);

    switch ($status) {
        case 'Confirmed':
            $mail->Subject = 'Booking Confirmed - Explore Pakistan';
            $mail->Body = "
                <h2>Booking Confirmed</h2>
                <p>Hello <strong>{$safeName}</strong>,</p>
                <p>Your booking for
                <strong>{$safeDestination}</strong> has been confirmed.</p>
                <p>Travel date: {$safeDate}</p>
                <p>Thank you for choosing Explore Pakistan.</p>
            ";
            break;

        case 'Cancelled':
            $mail->Subject = 'Booking Cancelled - Explore Pakistan';
            $mail->Body = "
                <h2>Booking Cancelled</h2>
                <p>Hello <strong>{$safeName}</strong>,</p>
                <p>Your booking for
                <strong>{$safeDestination}</strong> has been cancelled.</p>
                <p>Please contact us if you need assistance.</p>
            ";
            break;

        case 'Completed':
            $mail->Subject = 'Trip Completed - Explore Pakistan';
            $mail->Body = "
                <h2>Thank You for Travelling With Us</h2>
                <p>Hello <strong>{$safeName}</strong>,</p>
                <p>Your trip to
                <strong>{$safeDestination}</strong> has been completed.</p>
                <p>We hope you enjoyed your journey!</p>
            ";
            break;

        case 'Pending':
            $mail->Subject = 'Booking Pending - Explore Pakistan';
            $mail->Body = "
                <h2>Booking Pending</h2>
                <p>Hello <strong>{$safeName}</strong>,</p>
                <p>Your booking is currently under review.
                We will update you soon.</p>
            ";
            break;
    }

    $mail->send();

} catch (Throwable $e) {
    error_log(
        'Booking status email error: ' . $e->getMessage()
    );
}

// Return to the bookings page even if email sending fails.
header('Location: bookings.php');
exit();