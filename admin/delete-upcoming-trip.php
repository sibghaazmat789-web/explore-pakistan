<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

include("../php/db.php");

$id = $_GET['id'];

// Get image name
$result = mysqli_query($conn,"SELECT image FROM upcoming_trips WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

// Delete image from folder
if(file_exists("../images/upcoming/".$row['image'])){
    unlink("../images/upcoming/".$row['image']);
}

// Delete database record
mysqli_query($conn,"DELETE FROM upcoming_trips WHERE id='$id'");

header("Location: upcoming-trips.php");

?>