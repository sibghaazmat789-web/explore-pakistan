<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

include("../php/db.php");

if(isset($_GET['id'])){

    $id = $_GET['id'];

    // Get image name
    $query = "SELECT image FROM packages WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Delete image from folder
    if($row){
        $image = "../images/packages/" . $row['image'];

        if(file_exists($image)){
            unlink($image);
        }
    }

    // Delete package from database
    mysqli_query($conn, "DELETE FROM packages WHERE id='$id'");

    header("Location: packages.php?status=deleted");
    exit();
}

?>