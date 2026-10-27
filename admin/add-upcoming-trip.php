<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

include("../php/db.php");

if(isset($_POST['submit'])){

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

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    $gallery1=$_FILES['gallery1']['name'];
$tmp1=$_FILES['gallery1']['tmp_name'];

$gallery2=$_FILES['gallery2']['name'];
$tmp2=$_FILES['gallery2']['tmp_name'];

$gallery3=$_FILES['gallery3']['name'];
$tmp3=$_FILES['gallery3']['tmp_name'];

move_uploaded_file($tmp1,"../images/upcoming/".$gallery1);
move_uploaded_file($tmp2,"../images/upcoming/".$gallery2);
move_uploaded_file($tmp3,"../images/upcoming/".$gallery3);

    move_uploaded_file($tmp,"../images/upcoming/".$image);

    $query="INSERT INTO upcoming_trips(

title,
destination,
departure_date1,
departure_date2,
departure_date3,
duration,
price,
seats,
description,
overview,
itinerary,
included,
excluded,
hotel,
transport,
pickup_point,
difficulty,
image,
gallery1,
gallery2,
gallery3,
status

)

VALUES(

'$title',
'$destination',
'$departure_date1',
'$departure_date2',
'$departure_date3',
'$duration',
'$price',
'$seats',
'$description',
'$overview',
'$itinerary',
'$included',
'$excluded',
'$hotel',
'$transport',
'$pickup_point',
'$difficulty',
'$image',
'$gallery1',
'$gallery2',
'$gallery3',
'$status'

)";
    
    mysqli_query($conn,$query);

    header("Location: upcoming-trips.php");
}

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Add Upcoming Trip</title>

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

<h1>Add Upcoming Trip</h1>

<form method="POST" enctype="multipart/form-data" class="package-form">

<label>Trip Title</label>
<input type="text" name="title" required>

<label>Destination</label>
<input type="text" name="destination" required>

<label>Departure Date 1</label>
<input type="date" name="departure_date1" required>

<label>Departure Date 2</label>
<input type="date" name="departure_date2" required>

<label>Departure Date 3</label>
<input type="date" name="departure_date3" required>

<label>Duration</label>
<input type="text" name="duration" placeholder="5 Days" required>

<label>Price</label>
<input type="number" name="price" required>

<label>Available Seats</label>
<input type="number" name="seats" required>

<label>Description</label>
<textarea name="description" rows="6"></textarea>

<label>Overview</label>
<textarea name="overview" rows="5"></textarea>

<label>Itinerary</label>
<textarea name="itinerary" rows="8"
placeholder="Day 1: Islamabad to Naran&#10;Day 2: Naran to Hunza&#10;Day 3: Altit Fort"></textarea>

<label>Included</label>
<textarea name="included" rows="6"
placeholder="Luxury Transport&#10;Hotel Accommodation&#10;Breakfast"></textarea>

<label>Excluded</label>
<textarea name="excluded" rows="6"
placeholder="Lunch&#10;Personal Expenses&#10;Horse Riding"></textarea>

<label>Hotel</label>
<input type="text" name="hotel">

<label>Transport</label>
<input type="text" name="transport">

<label>Pickup Point</label>
<input type="text" name="pickup_point">

<label>Difficulty</label>

<select name="difficulty">

<option value="Easy">Easy</option>

<option value="Moderate">Moderate</option>

<option value="Hard">Hard</option>

</select>
<label>Trip Image</label>
<input type="file" name="image" required>

<label>Gallery Image 1</label>
<input type="file" name="gallery1">

<label>Gallery Image 2</label>
<input type="file" name="gallery2">

<label>Gallery Image 3</label>
<input type="file" name="gallery3">

<label>Status</label>

<select name="status">

<option value="Upcoming">Upcoming</option>

<option value="Completed">Completed</option>

</select>

<br><br>

<button type="submit" name="submit" class="add-btn">

<i class="fas fa-save"></i>

Save Trip

</button>

</form>

</div>

</div>

</body>

</html>