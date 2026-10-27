<?php

include("../php/db.php");

if(isset($_GET['id'])){

    $id = intval($_GET['id']);

    mysqli_query($conn,"DELETE FROM contacts WHERE id=$id");

}

header("Location: messages.php");

exit();

?>