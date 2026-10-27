<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

include("../php/db.php");

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM upcoming_trips WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $destination = mysqli_real_escape_string($conn,$_POST['destination']);
    $departure_date1 = $_POST['departure_date1'];
$departure_date2 = $_POST['departure_date2'];
$departure_date3 = $_POST['departure_date3'];
    $duration = mysqli_real_escape_string($conn,$_POST['duration']);
    $price = $_POST['price'];
    $seats = $_POST['seats'];

    $description = mysqli_real_escape_string($conn,$_POST['description']);
    $overview = mysqli_real_escape_string($conn,$_POST['overview']);
    $itinerary = mysqli_real_escape_string($conn,$_POST['itinerary']);
    $included = mysqli_real_escape_string($conn,$_POST['included']);
    $excluded = mysqli_real_escape_string($conn,$_POST['excluded']);
    $hotel = mysqli_real_escape_string($conn,$_POST['hotel']);
    $transport = mysqli_real_escape_string($conn,$_POST['transport']);
    $pickup_point = mysqli_real_escape_string($conn,$_POST['pickup_point']);
    $difficulty = mysqli_real_escape_string($conn,$_POST['difficulty']);

    $status = $_POST['status'];


    if($_FILES['image']['name']!=""){

        $image=$_FILES['image']['name'];
        $tmp=$_FILES['image']['tmp_name'];

        move_uploaded_file($tmp,"../images/upcoming/".$image);

    }else{

        $image=$row['image'];

    }


    $query = "UPDATE upcoming_trips SET

    title='$title',
    destination='$destination',
    departure_date1='$departure_date1',
    departure_date2='$departure_date2',
    departure_date3='$departure_date3',
    duration='$duration',
    price='$price',
    seats='$seats',
    description='$description',
    overview='$overview',
    itinerary='$itinerary',
    included='$included',
    excluded='$excluded',
    hotel='$hotel',
    transport='$transport',
    pickup_point='$pickup_point',
    difficulty='$difficulty',
    image='$image',
    status='$status'

    WHERE id='$id'";


    mysqli_query($conn,$query);

    header("Location: upcoming-trips.php");
exit();

}

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Edit Trip</title>

<link rel="stylesheet" href="admin.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="dashboard">

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

    <div class="main-content">

<h1>Edit Upcoming Trip</h1>

<form method="POST" enctype="multipart/form-data" class="package-form">

<label>Trip Title</label>
<input type="text" name="title" value="<?= $row['title']; ?>" required>

<label>Destination</label>
<input type="text" name="destination" value="<?= $row['destination']; ?>" required>
<label>Departure Date 1</label>
<input type="date"
name="departure_date1"
value="<?php echo $row['departure_date1']; ?>">

<label>Departure Date 2</label>
<input type="date"
name="departure_date2"
value="<?php echo $row['departure_date2']; ?>">

<label>Departure Date 3</label>
<input type="date"
name="departure_date3"
value="<?php echo $row['departure_date3']; ?>">

<label>Duration</label>
<input type="text" name="duration" value="<?= $row['duration']; ?>" required>

<label>Price</label>
<input type="number" name="price" value="<?= $row['price']; ?>" required>

<label>Seats</label>
<input type="number" name="seats" value="<?= $row['seats']; ?>" required>

<label>Overview</label>
<textarea name="overview" rows="5"><?php echo $row['overview']; ?></textarea>

<label>Description</label>
<textarea name="description" rows="6"><?php echo $row['description']; ?></textarea>

<label>Itinerary</label>
<textarea name="itinerary" rows="8"><?php echo $row['itinerary']; ?></textarea>

<label>What's Included</label>
<textarea name="included" rows="6"><?php echo $row['included']; ?></textarea>

<label>What's Excluded</label>
<textarea name="excluded" rows="6"><?php echo $row['excluded']; ?></textarea>

<label>Hotel</label>
<input type="text" name="hotel"
value="<?php echo $row['hotel']; ?>">

<label>Transport</label>
<input type="text" name="transport"
value="<?php echo $row['transport']; ?>">

<label>Pickup Point</label>
<input type="text" name="pickup_point"
value="<?php echo $row['pickup_point']; ?>">

<label>Difficulty</label>
<input type="text" name="difficulty"
value="<?php echo $row['difficulty']; ?>">

<label>Description</label>

<textarea name="description" rows="6"><?= $row['description']; ?></textarea>

<label>Current Image</label>

<br>

<img src="../images/upcoming/<?= $row['image']; ?>" width="180">

<br><br>

<label>Change Image</label>

<input type="file" name="image">

<label>Gallery Image 1</label>
<input type="file" name="gallery1">

<label>Gallery Image 2</label>
<input type="file" name="gallery2">

<label>Gallery Image 3</label>
<input type="file" name="gallery3">

<label>Status</label>

<select name="status">

<option value="Upcoming" <?= $row['status']=="Upcoming"?"selected":""; ?>>Upcoming</option>

<option value="Completed" <?= $row['status']=="Completed"?"selected":""; ?>>Completed</option>

</select>

<br><br>

<button class="add-btn" name="update">

Update Trip

</button>

</form>

</div>

</div>

</body>

</html>