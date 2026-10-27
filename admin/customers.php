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

<title>Bookings | Admin Panel</title>

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

<li>
    <a href="packages.php">
        <i class="fas fa-box"></i>
        <span>Packages</span>
    </a>
</li>

<li class="active">
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

<h1>Customers</h1>

<?php
if(isset($_GET['status']) && $_GET['status']=="deleted"){
?>
<div class="success-message">
    ✅ Booking deleted successfully.
</div>
<?php
}
?>

<br>

<input
type="text"
id="searchCustomer"
placeholder="Search Customer">

<br><br>

<table class="booking-table" id="bookingTable">

<tr>

<th>ID</th>

<th>Name</th>

<th>Email</th>

<th>Phone</th>

<th>Destination</th>

<th>Persons</th>

<th>Travel Date</th>

</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['full_name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td><?php echo $row['destination']; ?></td>

<td><?php echo $row['persons']; ?></td>

<td><?php echo $row['travel_date']; ?></td>

</tr>

<?php } ?>

</table>

</div>

<script src="admin.js"></script>

</body>

</html>