<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

include("../php/db.php");

// Total Bookings
$bookingQuery = "SELECT COUNT(*) AS totalBookings FROM bookings";
$bookingResult = mysqli_query($conn, $bookingQuery);
$bookingData = mysqli_fetch_assoc($bookingResult);
$totalBookings = $bookingData['totalBookings'];

// Total Messages
$messageQuery = "SELECT COUNT(*) AS totalMessages FROM contacts";
$messageResult = mysqli_query($conn, $messageQuery);
$messageData = mysqli_fetch_assoc($messageResult);
$totalMessages = $messageData['totalMessages'];

?>

<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Explore Pakistan | Admin Dashboard</title>

    <!-- Font Awesome -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="admin.css">

</head>

<body>

    <!-- ================= Sidebar ================= -->

    <aside class="sidebar">

        <div class="logo">
            <h2>Explore Pakistan</h2>
        </div>

        <ul>

    <li class="active">
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

    <li>

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

    <!-- ================= Main Content ================= -->

    <main class="main-content">

        <div class="header">

            <h1>Dashboard</h1>

            <div class="admin-profile">

                <i class="fas fa-user-circle"></i>

                <span>Welcome, Admin</span>

            </div>

        </div>

        <!-- Dashboard Cards -->

        <div class="cards">

            <div class="card">

                <i class="fas fa-calendar-check"></i>

                <h2><?php echo $totalBookings; ?></h2>

                <p>Total Bookings</p>

            </div>

            <div class="card">

                <i class="fas fa-envelope"></i>

                <h2><?php echo $totalMessages; ?></h2>

                <p>Messages</p>

            </div>

            <div class="card">

                <i class="fas fa-map-location-dot"></i>

                <h2>3</h2>

                <p>Packages</p>

            </div>

            <div class="card">

                <i class="fas fa-users"></i>

                <h2>0</h2>

                <p>Customers</p>

            </div>

        </div>

        <!-- Recent Activity -->

        <div class="recent">

    <h2>Recent Bookings</h2>

    <table>

        <thead>
            <tr>
                <th>Name</th>
                <th>Destination</th>
                <th>Persons</th>
                <th>Travel Date</th>
            </tr>
        </thead>

        <tbody>

        <?php

        $query = "SELECT * FROM bookings ORDER BY created_at DESC LIMIT 5";
        $result = mysqli_query($conn, $query);

        while($row = mysqli_fetch_assoc($result)){
        ?>

            <tr>

                <td><?php echo $row['full_name']; ?></td>

                <td><?php echo $row['destination']; ?></td>

                <td><?php echo $row['persons']; ?></td>

                <td><?php echo $row['travel_date']; ?></td>

            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

    </main>

    <script src="admin.js"></script>

</body>

</html>