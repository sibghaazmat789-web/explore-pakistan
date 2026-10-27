<?php

session_start();

if(!isset($_SESSION['admin'])){

    header("Location: login.php");
    exit();

}

include("../php/db.php");

$query = "SELECT * FROM bookings ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Packages | Admin Panel</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<link rel="stylesheet" href="admin.css">

</head>

<body>

<div class="sidebar">

<div class="logo">

<h2>Explore Pakistan</h2>

</div>

<ul>

<li>
<a href="dashboard.php">
<i class="fas fa-chart-line"></i>
<span>Dashboard</span>
</a>
</li>

<li>
<a href="bookings.php">
<i class="fas fa-calendar-check"></i>
<span>Bookings</span>
</a>
</li>

<li>
<a href="messages.php">
<i class="fas fa-envelope"></i>
<span>Messages</span>
</a>
</li>

<li class="active">
    <a href="packages.php">
        <i class="fas fa-box"></i>
        <span>Packages</span>
    </a>
</li>

<li>
    <a href="customers.php">
        <i class="fas fa-users"></i>
        <span>Customers</span>
    </a>
</li>

<li>
<a href="logout.php">
<i class="fas fa-right-from-bracket"></i>
<span>Logout</span>
</a>
</li>

</ul>

</div>

<div class="main-content">

<h1>Add New Package</h1>
<?php
if(isset($_GET['status']) && $_GET['status']=="deleted"){
?>
<div class="success-message">
    ✅ Package deleted successfully.
</div>
<?php
}
?>

<br>

<div class="top-bar">

    <a href="add-package.php" class="add-btn">
        <i class="fas fa-plus"></i>
        Add Package
    </a>

</div>

<br>

<form action="save-package.php" method="POST" enctype="multipart/form-data" class="package-form">

<label>Package Name</label>
<input type="text" name="title" required>

<label>Destination</label>
<input type="text" name="destination" required>

<label>Price</label>
<input type="text" name="price" required>

<label>Duration</label>
<input type="text" name="duration" placeholder="5 Days / 4 Nights" required>

<div class="form-group">
    <label>Rating</label>
    <input type="number"
           name="rating"
           step="0.1"
           min="1"
           max="5"
           placeholder="Example: 4.9"
           required>
</div>

<div class="form-group">
    <label>Reviews</label>
    <input type="number"
           name="reviews"
           placeholder="Example: 180"
           required>
</div>

<div class="form-group">
    <label>Badge</label>

    <select name="badge" required>

        <option value="Best Seller">Best Seller</option>

        <option value="Popular">Popular</option>

        <option value="New">New</option>

        <option value="Recommended">Recommended</option>

    </select>
</div>


<label>Package Image</label>
<input type="file" name="image" accept="image/*" required>

<br><br>

<button type="submit" class="add-btn">
    <i class="fas fa-save"></i>
    Save Package
</button>

</form>

</div>

<script src="admin.js"></script>

</body>

</html>