<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

include("../php/db.php");

$id=$_POST['id'];

$title=mysqli_real_escape_string($conn,$_POST['title']);
$destination=mysqli_real_escape_string($conn,$_POST['destination']);
$price=mysqli_real_escape_string($conn,$_POST['price']);
$duration=mysqli_real_escape_string($conn,$_POST['duration']);
$description=mysqli_real_escape_string($conn,$_POST['description']);

$imageQuery=mysqli_query($conn,"SELECT image FROM packages WHERE id='$id'");
$old=mysqli_fetch_assoc($imageQuery);

$image=$old['image'];

if($_FILES['image']['name']!=""){

    if(file_exists("../images/packages/".$image)){
        unlink("../images/packages/".$image);
    }

    $image=$_FILES['image']['name'];

    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        "../images/packages/".$image
    );
}

$query="UPDATE packages SET

title='$title',
destination='$destination',
price='$price',
duration='$duration',
description='$description',
image='$image'

WHERE id='$id'";

mysqli_query($conn,$query);

header("Location: packages.php");

exit();

?>