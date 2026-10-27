<?php

session_start();

if(!isset($_SESSION['admin'])){

    header("Location: login.php");
    exit();

}

include("../php/db.php");

$query="SELECT * FROM upcoming_trips ORDER BY departure_date ASC";

$result=mysqli_query($conn,$query);

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Upcoming Trips</title>

<link rel="stylesheet" href="admin.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="dashboard">

<aside class="sidebar">

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
                <i class="fas fa-map-marked-alt"></i>
                <span>Packages</span>
            </a>
        </li>

        <li class="active">
            <a href="upcoming-trips.php">
                <i class="fas fa-calendar-alt"></i>
                <span>Upcoming Trips</span>
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

</aside>

<div class="main-content">

<h1>

Upcoming Trips

</h1>

<a href="add-upcoming-trip.php" class="add-btn">

<i class="fas fa-plus"></i>

Add New Trip

</a>

<table>

<tr>

<th>ID</th>

<th>Image</th>

<th>Title</th>

<th>Destination</th>

<th>Date</th>

<th>Duration</th>

<th>Price</th>

<th>Seats</th>

<th>Status</th>

<th>Actions</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($result)){

?>

<tr>

<td><?= $row['id']; ?></td>

<td>

<img src="../images/upcoming/<?= $row['image']; ?>" width="90">

</td>

<td><?= $row['title']; ?></td>

<td><?= $row['destination']; ?></td>

<td><?= $row['departure_date']; ?></td>

<td><?= $row['duration']; ?></td>

<td>Rs. <?= number_format($row['price']); ?></td>

<td><?= $row['seats']; ?></td>

<td><?= $row['status']; ?></td>

<td>

<a href="edit-upcoming-trip.php?id=<?= $row['id']; ?>" class="edit-btn">

<i class="fas fa-edit"></i> Edit

</a>

<a href="delete-upcoming-trip.php?id=<?= $row['id']; ?>"
class="delete-btn"
onclick="return confirm('Delete this trip?')">

<i class="fas fa-trash"></i> Delete

</a>

</td>

</tr>

<?php

}

?>

</table>

</div>

</div>

</body>

</html>