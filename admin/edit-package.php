<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

include("../php/db.php");

$id = $_GET['id'];

$query = "SELECT * FROM packages WHERE id='$id'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">
<title>Edit Package</title>

<link rel="stylesheet" href="admin.css">

</head>

<body>

<div class="main-content">

<h1>Edit Package</h1>

<form action="update-package.php" method="POST" enctype="multipart/form-data" class="package-form">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<label>Package Name</label>

<input type="text"
name="title"
value="<?php echo $row['title']; ?>"
required>

<label>Destination</label>

<input type="text"
name="destination"
value="<?php echo $row['destination']; ?>"
required>

<label>Price</label>

<input type="text"
name="price"
value="<?php echo $row['price']; ?>"
required>

<label>Duration</label>

<input type="text"
name="duration"
value="<?php echo $row['duration']; ?>"
required>

<label>Description</label>

<textarea
name="description"
rows="5"><?php echo $row['description']; ?></textarea>

<br><br>

<img src="../images/packages/<?php echo $row['image']; ?>" width="200">

<br><br>

<label>Change Image</label>

<input type="file" name="image">

<br><br>

<button class="add-btn">
Update Package
</button>

</form>

</div>

</body>

</html>