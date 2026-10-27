
<?php

session_start();

include("../php/db.php");

if (
    $_SERVER['REQUEST_METHOD'] !== 'POST' ||
    !isset($_POST['username'], $_POST['password']) ||
    !is_string($_POST['username']) ||
    !is_string($_POST['password'])
) {
    header("Location: login.php");
    exit();
}

$username = trim($_POST['username']);
$password = $_POST['password'];

$stmt = $conn->prepare(
    "SELECT username, password FROM admins WHERE username = ? LIMIT 1"
);

$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();
$admin = $result->fetch_assoc();

$stmt->close();

if ($admin && password_verify($password, $admin['password'])) {

    // Prevent session fixation
    session_regenerate_id(true);

    $_SESSION['admin'] = $admin['username'];

    header("Location: dashboard.php");
    exit();
}

header("Location: login.php?error=1");
exit();
