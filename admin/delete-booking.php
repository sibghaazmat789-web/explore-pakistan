<?php

include("../php/db.php");

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $query = "DELETE FROM bookings WHERE id = $id";

    if(mysqli_query($conn, $query)){

        header("Location: bookings.php?status=deleted");
        exit();

    }else{

        echo "Error deleting booking.";

    }

}else{

    header("Location: bookings.php");
    exit();

}

?>