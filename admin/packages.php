<?php

session_start();

if(!isset($_SESSION['admin'])){

    header("Location: login.php");
    exit();

}

include("../php/db.php");

$query = "SELECT * FROM packages ORDER BY created_at DESC";
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

<h1>Tour Packages</h1>

<?php
if(isset($_GET['status']) && $_GET['status']=="added"){
?>
<div class="success-message">
    ✅ Package added successfully.
</div>
<?php
}
?>

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

<input
type="text"
id="searchPackage"
placeholder="Search Package">

<br><br>

<table class="booking-table">

<tr>
    <th>ID</th>
    <th>Image</th>
    <th>Package Name</th>
    <th>Destination</th>
    <th>Price</th>
    <th>Duration</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>

    <td><?php echo $row['id']; ?></td>

    <td>
        <img src="../images/packages/<?php echo $row['image']; ?>" width="80">
    </td>

    <td><?php echo $row['title']; ?></td>

    <td><?php echo $row['destination']; ?></td>

    <td><?php echo $row['price']; ?></td>

    <td><?php echo $row['duration']; ?></td>

    <td>

        <a href="edit-package.php?id=<?php echo $row['id']; ?>" class="edit-btn">
            <i class="fas fa-pen"></i>
        </a>

        <a href="delete-package.php?id=<?php echo $row['id']; ?>"
           class="delete-btn"
           onclick="return confirm('Delete this package?')">

            <i class="fas fa-trash"></i>

        </a>

    </td>

</tr>

<?php } ?>

</table>

</div>

<script src="admin.js"></script>

</body>

</html>