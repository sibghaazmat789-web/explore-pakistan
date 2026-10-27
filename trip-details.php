<?php

include("php/db.php");


// Check trip id

if(!isset($_GET['id'])){

    header("Location: upcoming-trips.php");
    exit();

}


$id = $_GET['id'];


// Fetch trip details

$query = "SELECT * FROM upcoming_trips WHERE id='$id'";

$result = mysqli_query($conn,$query);


if(mysqli_num_rows($result)==0){

    echo "Trip not found";
    exit();

}


$trip = mysqli_fetch_assoc($result);



?>



<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
<?php echo $trip['title']; ?>
</title>


<link rel="stylesheet" href="css/trip-detail.css">


<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

</head>


<body>
<!-- ================= NAVBAR ================= -->
<!-- ================= HERO ================= -->


<section class="trip-hero">


<img src="images/upcoming/<?php echo $trip['image']; ?>" alt="<?php echo $trip['title']; ?>">

<div class="hero-overlay">


<div>


<h1>
<?php echo $trip['title']; ?>
</h1>


<p>
<?php echo $trip['destination']; ?>
</p>


</div>


</div>


</section>
<!-- ================= MAIN CONTAINER ================= -->


<div class="trip-container">
<!-- ================= LEFT CONTENT ================= -->


<div class="trip-content">





<!-- Gallery -->


<section class="gallery">


<h2>
Trip Gallery
</h2>



<div class="gallery-grid">


<img src="images/upcoming/<?php echo $trip['image']; ?>" alt="">
<img src="images/upcoming/<?php echo $trip['gallery1']; ?>" alt="">
<img src="images/upcoming/<?php echo $trip['gallery2']; ?>" alt="">
<img src="images/upcoming/<?php echo $trip['gallery3']; ?>" alt="">

</div>


</section>

<!-- Quick Info -->


<section class="quick-info">


<div>

<i>📅</i>

<h4>
Duration
</h4>

<p>
<?php echo $trip['duration']; ?>
</p>

</div>



<div>

<i>💰</i>

<h4>
Price
</h4>

<p>
PKR <?php echo $trip['price']; ?>
</p>

</div>



<div>

<i>🪑</i>

<h4>
Seats
</h4>

<p>
<?php echo $trip['seats']; ?>
Available
</p>

</div>




<div>

<i>🏔️</i>

<h4>
Difficulty
</h4>


<p>
<?php echo $trip['difficulty']; ?>
</p>

</div>



</section>

<!-- Overview -->


<section class="trip-section">


<h2>
Overview
</h2>


<p>

<?php echo nl2br($trip['overview']); ?>

</p>


</section>








<!-- Description -->


<section class="trip-section">


<h2>
Description
</h2>


<p>

<?php echo nl2br($trip['description']); ?>

</p>


</section>

<!-- ================= DEPARTURE CALENDAR ================= -->




<!-- ================= ITINERARY TIMELINE ================= -->


<section class="trip-section itinerary-section">


<h2 class="accordion-title">

Trip Itinerary

<span>
+
</span>

</h2>



<div class="accordion-content timeline">


<?php


$days = explode("\n",$trip['itinerary']);


$count = 1;


foreach($days as $day){


    if(trim($day) != ""){


?>


<div class="timeline-item">


<div class="timeline-number">

<?php echo $count; ?>

</div>




<div class="timeline-content">


<p>

<?php echo $day; ?>

</p>


</div>



</div>



<?php


$count++;


    }


}


?>


</div>



</section>

<!-- ================= INCLUDED / EXCLUDED ================= -->


<section class="trip-section include-exclude">


<div class="included-box">


<h2 class="accordion-title">

✓ What's Included

<span>
+
</span>

</h2>



<div class="accordion-content">

<ul>


<?php


$included_items = explode("\n",$trip['included']);


foreach($included_items as $item){


    if(trim($item)!=""){


        echo "<li>$item</li>";


    }


}


?>


</ul>

</div>

</div>





<div class="excluded-box">


<h2 class="accordion-title">

✓ What's Excluded

<span>
+
</span>

</h2>



<div class="accordion-content">

<ul>


<?php


$excluded_items = explode("\n",$trip['excluded']);


foreach($excluded_items as $item){


    if(trim($item)!=""){


        echo "<li>$item</li>";


    }


}


?>


</ul>

</div>

</div>



</section>

<!-- ================= TRAVEL INFORMATION ================= -->


<section class="trip-section travel-info">


<h2>
Travel Information
</h2>




<div class="travel-grid">



<div class="travel-card">


<h3>
🏨 Hotel
</h3>


<p>
<?php echo $trip['hotel']; ?>
</p>


</div>




<div class="travel-card">


<h3>
🚐 Transport
</h3>


<p>
<?php echo $trip['transport']; ?>
</p>


</div>




<div class="travel-card">


<h3>
📍 Pickup Point
</h3>


<p>
<?php echo $trip['pickup_point']; ?>
</p>


</div>

</div>


</section>

</div>

<!-- ================= SIDEBAR ================= -->



<aside class="booking-sidebar">

<div class="booking-card">

<h2>Reserve Your Seat</h2>

<!-- Participants -->

<div class="booking-block">

<h4>Participants</h4>

<div class="participant-box">

<button type="button" onclick="changePersons(-1)">−</button>

<input
type="text"
id="persons"
value="1"
readonly>

<button type="button" onclick="changePersons(1)">+</button>

</div>

</div>

<!-- Calendar -->

<div class="booking-block">

<h4>Choose Departure</h4>

<input
type="text"
id="tripCalendar">

</div>

<!-- Summary -->

<div class="booking-summary">

<h3>Booking Summary</h3>

<p><strong>Trip:</strong> <?php echo $trip['title']; ?></p>

<p><strong>Destination:</strong> <?php echo $trip['destination']; ?></p>

<p><strong>Departure:</strong>

<span id="selectedDate">

<?php echo date("d M Y",strtotime($trip['departure_date1'])); ?>

</span>

</p>

<p><strong>Duration:</strong>

<?php echo $trip['duration']; ?>

</p>

<p>

<strong>Persons:</strong>

<span id="summaryPersons">1</span>

</p>

<h2>

PKR

<span id="totalPrice">

<?php echo $trip['price']; ?>

</span>

</h2>

</div>

<a href="#booking" class="book-btn">

Book This Trip

</a>

</div>

</aside>

</div>
<!-- Booking Section -->

<section id="booking" class="book-section">
<h2>
Reserve Your Adventure
</h2>

<p>
Secure your seat for this upcoming trip.
</p>

<form action="php/booking.php" method="POST">

<input
type="hidden"
name="trip_id"
value="<?php echo $trip['id']; ?>">

<input type="hidden" name="trip_id" value="<?php echo $trip['id']; ?>">

<input type="hidden" name="destination"
value="<?php echo $trip['destination']; ?>">



<input type="hidden" name="trip"
value="<?php echo $trip['title']; ?>">

<input
type="hidden"
id="selectedDeparture"
name="travel_date"
value="<?php echo $trip['departure_date1']; ?>">



<div class="form-grid">


<input 
type="text"
name="full_name"
placeholder="Full Name"
required
>



<input 
type="email"
name="email"
placeholder="Email"
required
>



<input 
type="text"
name="phone"
placeholder="Phone Number"
required
>




<input 
type="number"
name="persons"
placeholder="Number of Persons"
required
>



</div>




<textarea 
name="special_request"
placeholder="Special Request">
</textarea>




<button type="submit" name="book" class="booking-btn">
    Confirm Booking
</button>



</form>



</section>
<!-- ================= RELATED UPCOMING TRIPS ================= -->


<section class="related-trips">


<h2>
Explore More Upcoming Trips
</h2>




<div class="related-grid">



<?php


$related_query = "

SELECT * FROM upcoming_trips

WHERE id != '$id'

AND status='Active'

ORDER BY id DESC

LIMIT 3

";



$related_result = mysqli_query($conn,$related_query);



while($related = mysqli_fetch_assoc($related_result)){


?>


<div class="related-card">



<img src="images/upcoming/<?php echo $related['image']; ?>" alt="<?php echo $related['title']; ?>">



<div class="related-content">



<h3>

<?php echo $related['title']; ?>

</h3>



<p>

<?php echo $related['destination']; ?>

</p>



<div class="related-info">


<span>

<?php echo $related['duration']; ?>

</span>


<strong>

PKR <?php echo $related['price']; ?>

</strong>


</div>

<a href="trip-details.php?id=<?php echo $related['id']; ?>">

View Details

</a>

</div>

</div>

<?php
}

?>

</div>

</section>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>

const price = <?php echo $trip['price']; ?>;

flatpickr("#tripCalendar",{

    enable:[
        "<?php echo $trip['departure_date1']; ?>",
        "<?php echo $trip['departure_date2']; ?>",
        "<?php echo $trip['departure_date3']; ?>"
    ],

    defaultDate:"<?php echo $trip['departure_date1']; ?>",

    dateFormat:"d M Y",

    disableMobile:true,

    onChange:function(selectedDates,dateStr){

    document.getElementById("selectedDate").innerHTML = dateStr;

    document.getElementById("selectedDeparture").value = dateStr;

}

});
function changePersons(value){

    let input=document.getElementById("persons");

    let persons=parseInt(input.value);

    persons+=value;

    if(persons<1) persons=1;

    input.value=persons;

    document.getElementById("summaryPersons").innerHTML=persons;

    document.getElementById("totalPrice").innerHTML=(persons*price).toLocaleString();

}

</script>

<script src="trip-details.js"></script>

</body>

</html>