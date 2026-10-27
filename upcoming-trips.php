<?php

include("php/db.php");

$query = "SELECT * FROM upcoming_trips
          WHERE status='Upcoming'
          ORDER BY departure_date ASC";

$result = mysqli_query($conn,$query);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Upcoming Trips | Explore Pakistan</title>

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/upcoming-trips.css">
<link rel="stylesheet" href="css/responsive.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>
    
    <a href="index.php#home" class="back-home-btn">
    <i class="fas fa-arrow-left"></i>
    Back to Home
</a>

<header id="home">

        <nav class="navbar">
    <div class="logo">
        <a href="index.php#home">🌄 Explore Pakistan</a>
    </div>

    <ul class="nav-links">
        <li><a href="index.php#home">Home</a></li>
        <li><a href="index.php#destinations">Destinations</a></li>
        <li><a href="index.php#categories">Categories</a></li>
        <li><a href="index.php#packages">Packages</a></li>
        <li><a href="upcoming-trips.php">Upcoming Trips</a></li>
        <li><a href="index.php#gallery">Gallery</a></li>
        <li><a href="index.php#contact">Contact</a></li>
    </ul>
            <div class="menu-btn">
             <i class="fas fa-bars"></i>
            </div>

            <!-- Book Now Button -->
            <a href="#booking" class="btn-book">
    Book Now
</a>

            <!-- Mobile Menu -->
            <div class="menu-toggle">
                ☰
            </div>

        </nav>
    </header>

    <section class="upcoming-hero">

<div class="upcoming-overlay">

<span class="hero-tag">

UPCOMING TRIPS

</span>

<h1>

Adventure Begins With One Booking

</h1>

<p>

Discover our carefully planned departures across Pakistan.
Whether you're chasing snowy peaks, cultural festivals,
or breathtaking valleys, your next unforgettable journey starts here.

</p>

</div>

</section>

<section class="upcoming-intro">

<div class="intro-container">

<span class="section-tag">

LIMITED SEATS AVAILABLE

</span>

<h2>

Choose Your Next Journey

</h2>

<p>

Our upcoming departures are professionally organized with premium
transportation, experienced tour guides, comfortable hotels,
and unforgettable experiences. Book early to secure your seat.

</p>

</div>

</section>

<section class="upcoming-trips">

<div class="trip-container">

<?php

if(mysqli_num_rows($result)>0){

while($row=mysqli_fetch_assoc($result)){

?>

<div class="trip-card">

<div class="trip-image">

<img src="images/upcoming/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>">

<?php

$day = date("d", strtotime($row['departure_date']));
$month = date("M", strtotime($row['departure_date']));
$year = date("Y", strtotime($row['departure_date']));

?>

<div class="calendar-badge">

    <div class="calendar-month">

        <?php echo strtoupper($month); ?>

    </div>

    <div class="calendar-day">

        <?php echo $day; ?>

    </div>

    <div class="calendar-year">

        <?php echo $year; ?>

    </div>

</div>

</div>

<div class="trip-content">

<span class="trip-destination">

<i class="fas fa-location-dot"></i>

<?php echo $row['destination']; ?>

</span>

<h3>

<?php echo $row['title']; ?>

</h3>

<p>

<?php echo $row['description']; ?>

</p>

<div class="trip-info">

<div>

<i class="fas fa-clock"></i>

<?php echo $row['duration']; ?>

</div>

<div>

<i class="fas fa-users"></i>

<?php echo $row['seats']; ?> Seats

</div>

</div>

<div class="trip-footer">

<h4>

Rs. <?php echo number_format($row['price']); ?>

</h4>

<a href="trip-details.php?id=<?=$row['id']?>"
class="btn-book">

View Details

</a>

</div>

</div>

</div>

<?php

}

}else{

?>

<h2 style="text-align:center;width:100%;padding:80px;">

No Upcoming Trips Available

</h2>

<?php

}

?>

</div>

</section>

<section class="upcoming-cta">

<div class="cta-content">

<h2>

Ready For Your Next Adventure?

</h2>

<p>

Reserve your seat today and experience Pakistan through expertly crafted journeys,
luxury accommodations, and unforgettable memories.

</p>

<a href="index.php#booking" class="cta-btn">

Book Your Trip

</a>

</div>

</section>

<script src="script.js"></script>

</body>

</html>