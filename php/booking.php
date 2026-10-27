<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once __DIR__ . '/../PHPMailer/Exception.php';
require_once __DIR__ . '/../PHPMailer/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer/SMTP.php';
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['book'])) {
    http_response_code(400);
    exit('Invalid booking request.');
}

$full_name       = trim($_POST['full_name'] ?? '');
$email           = trim($_POST['email'] ?? '');
$phone           = trim($_POST['phone'] ?? '');
$destination     = trim($_POST['destination'] ?? '');
$persons         = (int)($_POST['persons'] ?? 0);
$travel_date     = trim($_POST['travel_date'] ?? '');
$special_request = trim($_POST['special_request'] ?? '');
$trip_id         = (int)($_POST['trip_id'] ?? 0);

if (
    $full_name === '' ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    $phone === '' ||
    $destination === '' ||
    $persons < 1 ||
    $travel_date === ''
) {
    http_response_code(400);
    exit('Please complete all required booking fields correctly.');
}

// 1. Save booking in the database.
try {
    $stmt = $conn->prepare(
        "INSERT INTO bookings
        (full_name, email, phone, destination, persons, travel_date, special_request)
        VALUES (?, ?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        'ssssiss',
        $full_name,
        $email,
        $phone,
        $destination,
        $persons,
        $travel_date,
        $special_request
    );

    $stmt->execute();
    $stmt->close();
} catch (Throwable $e) {
    error_log('Booking database error: ' . $e->getMessage());
    http_response_code(500);
    exit('Your booking could not be saved. Please try again later.');
}

// 2. Send emails. The database booking is retained if email fails.
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
    $safePhone = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
    $safeDestination = htmlspecialchars($destination, ENT_QUOTES, 'UTF-8');
    $safeDate = htmlspecialchars($travel_date, ENT_QUOTES, 'UTF-8');
    $safeRequest = nl2br(
        htmlspecialchars($special_request, ENT_QUOTES, 'UTF-8')
    );

    // Email 1: Administrator notification
    try {
        $adminMail = new PHPMailer(true);
        $adminMail->isSMTP();
        $adminMail->Host = 'smtp.gmail.com';
        $adminMail->SMTPAuth = true;
        $adminMail->Username = $config['smtp_user'];
        $adminMail->Password = $config['smtp_pass'];
        $adminMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $adminMail->Port = 587;
        $adminMail->Timeout = 20;
        $adminMail->CharSet = 'UTF-8';

        $adminMail->setFrom($config['smtp_user'], 'Explore Pakistan');
        $adminMail->addAddress($config['admin_email']);
        $adminMail->addReplyTo($email, $full_name);
        $adminMail->isHTML(true);
        $adminMail->Subject = 'New Tour Booking';

        $adminMail->Body = "
            <h2>New Tour Booking</h2>
            <p><strong>Name:</strong> {$safeName}</p>
            <p><strong>Email:</strong> {$safeEmail}</p>
            <p><strong>Phone:</strong> {$safePhone}</p>
            <p><strong>Destination:</strong> {$safeDestination}</p>
            <p><strong>Persons:</strong> {$persons}</p>
            <p><strong>Travel Date:</strong> {$safeDate}</p>
            <p><strong>Special Request:</strong><br>{$safeRequest}</p>
        ";

        $adminMail->AltBody =
            "New Tour Booking\nName: {$full_name}\nEmail: {$email}\n" .
            "Phone: {$phone}\nDestination: {$destination}\n" .
            "Persons: {$persons}\nTravel Date: {$travel_date}\n" .
            "Special Request: {$special_request}";

        $adminMail->send();
    }  catch (Throwable $e) {
    file_put_contents(
        __DIR__ . '/email-debug.txt',
        date('c') . ' ADMIN EMAIL ERROR: ' .
        $e->getMessage() . PHP_EOL,
        FILE_APPEND
    );
}

    // Email 2: Customer confirmation, attempted separately.
    try {
        $customerMail = new PHPMailer(true);
        $customerMail->isSMTP();
        $customerMail->Host = 'smtp.gmail.com';
        $customerMail->SMTPAuth = true;
        $customerMail->Username = $config['smtp_user'];
        $customerMail->Password = $config['smtp_pass'];
        $customerMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $customerMail->Port = 587;
        $customerMail->Timeout = 20;
        $customerMail->CharSet = 'UTF-8';

        $customerMail->setFrom($config['smtp_user'], 'Explore Pakistan');
        $customerMail->addAddress($email, $full_name);
        $customerMail->isHTML(true);
        $customerMail->Subject = 'Booking Confirmation - Explore Pakistan';

        $customerMail->Body = "
            <h2>Thank You, {$safeName}!</h2>
            <p>Your booking has been received successfully.</p>
            <h3>Booking Details</h3>
            <ul>
                <li><strong>Destination:</strong> {$safeDestination}</li>
                <li><strong>Persons:</strong> {$persons}</li>
                <li><strong>Travel Date:</strong> {$safeDate}</li>
            </ul>
            <p>Our team will contact you within 24 hours.</p>
            <p><strong>Explore Pakistan Team</strong></p>
        ";

        $customerMail->AltBody =
            "Thank you, {$full_name}!\nYour booking has been received.\n" .
            "Destination: {$destination}\nPersons: {$persons}\n" .
            "Travel Date: {$travel_date}\n" .
            "Our team will contact you within 24 hours.";

                $customerMail->send();

    } catch (Throwable $e) {
        file_put_contents(
            __DIR__ . '/email-debug.txt',
            date('c') . ' CUSTOMER EMAIL ERROR: ' .
            $e->getMessage() . PHP_EOL,
            FILE_APPEND
        );
    }

} catch (Throwable $e) {
    file_put_contents(
        __DIR__ . '/email-debug.txt',
        date('c') . ' EMAIL SETUP ERROR: ' .
        $e->getMessage() . PHP_EOL,
        FILE_APPEND
    );
}

// 3. Redirect after saving the booking.
// 3. Redirect after saving the booking.
if ($trip_id > 0) {
    header(
        'Location: ../trip-details.php?id=' .
        $trip_id . '&booking=success#booking'
    );
} else {
    header('Location: ../index.php?booking=success#booking');
}

exit();
