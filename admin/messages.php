<?php

session_start();

if(!isset($_SESSION['admin'])){

    header("Location: login.php");
    exit();

}

include("../php/db.php");

$query = "SELECT * FROM contacts ORDER BY id DESC";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Messages | Admin Panel</title>

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

<li class="active">
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

<h1>Contact Messages</h1>

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

<input type="text"
id="searchBooking"
placeholder="Search by Name or Subject"
<br><br>

<table class="booking-table" id="messageTable">

<thead>

<tr>

<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Subject</th>
<th>Message</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['full_name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['subject']; ?></td>

<td><?php echo substr($row['message'],0,60); ?>...</td>

<td>

<a href="delete-message.php?id=<?php echo $row['id']; ?>"
class="delete-btn"
onclick="return confirm('Delete this message?')">

<i class="fas fa-trash"></i>

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<script src="admin.js"></script>

</body>

</html>