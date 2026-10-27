<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

include("../php/db.php");

// Get form data
$title = mysqli_real_escape_string($conn, $_POST['title']);
$destination = mysqli_real_escape_string($conn, $_POST['destination']);
$price = mysqli_real_escape_string($conn, $_POST['price']);
$duration = mysqli_real_escape_string($conn, $_POST['duration']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$rating = mysqli_real_escape_string($conn, $_POST['rating']);
$reviews = mysqli_real_escape_string($conn, $_POST['reviews']);
$badge = mysqli_real_escape_string($conn, $_POST['badge']);
// Image upload
$imageName = $_FILES['image']['name'];
$tmpName = $_FILES['image']['tmp_name'];

$imagePath = "../images/packages/" . $imageName;

// Move image to folder
move_uploaded_file($tmpName, $imagePath);

// Save to database
$query = "INSERT INTO packages
(title, destination, price, duration, rating, reviews, badge, description, image)
VALUES
('$title',
'$destination',
'$price',
'$duration',
'$rating',
'$reviews',
'$badge',
'$description',
'$imageName')";

if(mysqli_query($conn, $query)){

    header("Location: packages.php?status=added");
    exit();

}else{

    echo "Error: " . mysqli_error($conn);

}

?>