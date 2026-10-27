<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Login | Explore Pakistan</title>

<link rel="stylesheet" href="admin.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<div class="login-container">

<div class="login-box">

<h2>Admin Login</h2>

<p>Explore Pakistan Dashboard</p>

<?php
if(isset($_GET['error'])){
?>
<div class="login-error">
    ❌ Invalid Username or Password
</div>
<?php
}
?>

<form action="login-process.php" method="POST">

<div class="input-box">

<i class="fas fa-user"></i>

<input
type="text"
name="username"
placeholder="Username"
required>

</div>

<div class="input-box">

<i class="fas fa-lock"></i>

<input
type="password"
name="password"
id="password"
placeholder="Password"
required>

<i class="fas fa-eye" id="togglePassword"></i>

</div>

<button type="submit" class="login-btn">

Login

</button>

</form>

</div>

</div>

<script src="admin.js"></script>

</body>

</html>