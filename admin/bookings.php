<?php

session_start();

if(!isset($_SESSION['admin'])){

    header("Location: login.php");
    exit();

}

include("../php/db.php");

$query = "SELECT * FROM bookings ORDER BY id DESC";
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

<li class="active">
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

<h1>All Tour Bookings</h1>

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
placeholder="Search by Name or Destination">

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
<th>Status</th>
<th>Action</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['full_name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td><?php echo $row['destination']; ?></td>

<td><?php echo $row['persons']; ?></td>

<td><?php echo $row['travel_date']; ?></td>

<td>

<?php

$status = $row['status'];

if($status == "Pending"){

    echo '
    <span class="status-badge pending">
        <i class="fas fa-clock"></i>
        Pending
    </span>';

}

elseif($status == "Confirmed"){

    echo '
    <span class="status-badge confirmed">
        <i class="fas fa-check-circle"></i>
        Confirmed
    </span>';

}

elseif($status == "Cancelled"){

    echo '
    <span class="status-badge cancelled">
        <i class="fas fa-times-circle"></i>
        Cancelled
    </span>';

}

elseif($status == "Completed"){

    echo '
    <span class="status-badge completed">
        <i class="fas fa-flag-checkered"></i>
        Completed
    </span>';

}

else{

    echo '
    <span class="status-badge pending">
        <i class="fas fa-clock"></i>
        Pending
    </span>';

}

?>

</td>
<td>


<a href="update_status.php?id=<?php echo $row['id']; ?>&status=Confirmed"
class="approve-btn">

<i class="fas fa-check"></i>
Approve

</a>


<a href="update_status.php?id=<?php echo $row['id']; ?>&status=Cancelled"
class="reject">

<i class="fas fa-times"></i>
Reject

</a>


<a class="delete-btn"
href="delete-booking.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this booking?')">

<i class="fas fa-trash"></i>

</a>

<a href="update_status.php?id=<?php echo $row['id']; ?>&status=Completed"
class="complete-btn">

<i class="fas fa-flag-checkered"></i>
Complete

</a>


</td>

</tr>

<?php } ?>

</table>

</div>

<script src="admin.js"></script>

</body>

</html>