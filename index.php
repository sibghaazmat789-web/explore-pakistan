<?php
include("php/db.php");

$query = "SELECT * FROM packages ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Explore Pakistan | Luxury Tourism</title>

    <!-- CSS File -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

    <!-- ================= NAVBAR START ================= -->

    <header id="home">

<nav class="navbar">

<div class="logo">
    <a href="#">🌄 Explore Pakistan</a>
</div>

<ul class="nav-links">

<li><a href="#home">Home</a></li>

<li><a href="#destinations">Destinations</a></li>

<li><a href="#categories">Categories</a></li>

<li><a href="#packages">Packages</a></li>

<li><a href="upcoming-trips.php">Upcoming Trips</a></li>

<li><a href="#gallery">Gallery</a></li>

<li><a href="#contact">Contact</a></li>

</ul>

<button type="button" class="menu-btn"
        aria-label="Open navigation menu"
        aria-expanded="false">
    <i class="fas fa-bars"></i>
</button>

<a href="javascript:void(0)" class="btn-book"
onclick="openBooking()">

Book Now

</a>

</nav>

</header>

    <!-- Hero Section will come here -->
     <!-- ================= HERO SECTION START ================= -->

<section class="hero">

    <!-- Hero Background Slider -->
    <div class="hero-slider">

        <div class="hero-slide active"></div>
        <div class="hero-slide"></div>
        <div class="hero-slide"></div>

    </div>

    <!-- Background Overlay -->
    <div class="overlay"></div>

    <!-- Hero Content -->
    <div class="hero-content">

        <p class="hero-subtitle">
            Welcome to Pakistan
        </p>

        <h1>
            Discover the Beauty <br>
            Beyond the Mountains
        </h1>

        <p class="hero-text">
            Explore breathtaking valleys, majestic mountains,
            crystal-clear lakes, and unforgettable adventures
            across Pakistan.
        </p>

        <div class="hero-buttons">

            <a href="#destinations" class="btn-primary">
                Explore Now
            </a>

            <a href="#" class="btn-secondary" onclick="openVideo(event)">
    <i class="fas fa-play"></i> Watch Video
</a>

        </div>

    </div>

    <div class="scroll-down">
        ↓ Scroll Down
    </div>

</section>

<!-- ================= HERO SECTION END ================= -->

    <!-- ================= SEARCH SECTION START ================= -->

<section class="search-section">

    <div class="search-container">

        <!-- Destination -->
        <div class="search-box">

            <label>Destination</label>

            <div class="input-group">
                <i class="fas fa-location-dot"></i>

                <select id="destination">
                    <option value="">Choose Destination</option>
                    <option value="Hunza Valley">Hunza Valley</option>
                    <option value="Skardu">Skardu</option>
                    <option value="Fairy Meadows">Fairy Meadows</option>
                    <option value="Neelum Valley">Neelum Valley</option>
                    <option value="Swat Valley">Swat Valley</option>
                </select>
            </div>

        </div>

        <!-- Check In -->
        <div class="search-box">

            <label>Check In</label>

            <div class="input-group">
                <i class="fas fa-calendar-days"></i>

                <input type="date" id="checkin">
            </div>

        </div>

        <!-- Guests -->
        <div class="search-box">

            <label>Guests</label>

            <div class="input-group">
                <i class="fas fa-users"></i>

                <input
                    type="number"
                    id="guests"
                    placeholder="Number of Guests"
                    min="1">
            </div>

        </div>

        <!-- Search Button -->

        <div class="search-button">

            <button
                type="button"
                onclick="searchTour()"
                class="search-btn">

                <i class="fas fa-search"></i>

                Search Tour

            </button>

        </div>

    </div>

</section>

<div id="searchMessage" class="search-message"></div>
<!-- ================= SEARCH SECTION END ================= -->

<section class="about-pakistan">

    <div class="about-left">

        <span class="small-title">
            DISCOVER PAKISTAN
        </span>

        <h2>
            Experience the Untouched Beauty of Pakistan
        </h2>

        <p>
            Pakistan is a land of breathtaking landscapes, towering mountains,
            crystal-clear lakes, lush green valleys, and centuries-old cultural
            heritage. From the snow-capped peaks of Gilgit-Baltistan to the
            peaceful meadows of Fairy Meadows and the vibrant valleys of Swat,
            every destination offers a unique story waiting to be explored.
        </p>

        <p>
            Whether you're looking for adventure, relaxation, family vacations,
            or unforgettable road trips, our carefully designed tours ensure
            comfort, safety, and memorable experiences. We believe every journey
            should be more than a trip—it should become a lifelong memory.
        </p>

        <a href="explore.php" class="about-btn">
    Journey Through Pakistan →
</a>

    </div>

    <div class="about-right">

        <img src="images/about.jfif" alt="Pakistan">

    </div>

</section>

<!-- ================= DESTINATIONS SECTION START ================= -->

<section class="destinations" id="destinations">

    <div class="section-title">
        <p>Top Destinations</p>
        <h2>Explore Pakistan's Beautiful Places</h2>
    </div>

    <div class="destination-grid">

        <div class="destination-card">

    <img src="images/destination/hunza valley.jpg" alt="Hunza Valley">

    <div class="card-content">

        <span class="rating">
            ⭐ 4.9
        </span>

        <h3>Hunza Valley</h3>

        <p><i class="fas fa-location-dot"></i> Gilgit Baltistan</p>

        <div class="card-bottom">

            <span class="price">
                From <strong>Rs. 18,000</strong>
            </span>

           <button class="explore-btn" onclick="openDestination('Hunza')">
    Explore
</button>
        </div>

    </div>

</div>

        <div class="destination-card">

    <img src="images/destination/skardu.jpg" alt="Skardu">

    <div class="card-content">

        <span class="rating">
            ⭐ 4.8
        </span>

        <h3>Skardu</h3>

        <p><i class="fas fa-location-dot"></i> Gilgit Baltistan</p>

        <div class="card-bottom">

            <span class="price">
                From <strong>Rs. 20,000</strong>
            </span>

           <button class="explore-btn" onclick="openDestination('Skardu')">
    Explore
</button>

        </div>

    </div>

</div>

        <div class="destination-card">

    <img src="images/destination/neelum valley.jpg" alt="Neelum Valley">

    <div class="card-content">

        <span class="rating">
            ⭐ 4.7
        </span>

        <h3>Neelum Valley</h3>

        <p><i class="fas fa-location-dot"></i> Azad Kashmir</p>

        <div class="card-bottom">

            <span class="price">
                From <strong>Rs. 19,000</strong>
            </span>

           <button class="explore-btn" onclick="openDestination('Neelum Valley')">
    Explore
</button>

        </div>

    </div>

</div>

       <div class="destination-card">

    <img src="images/destination/naran kaghan.avif" alt="Naran Kaghan">

    <div class="card-content">

        <span class="rating">
            ⭐ 4.7
        </span>

        <h3>Naran kaghan</h3>

        <p><i class="fas fa-location-dot"></i>Khyber Pakhtunkhwa</p>

        <div class="card-bottom">

            <span class="price">
                From <strong>Rs. 21,000</strong>
            </span>

           <button class="explore-btn" onclick="openDestination('Naran Kaghan')">
    Explore
</button>

        </div>

    </div>

</div>

        <div class="destination-card">

    <img src="images/destination/fairy meadows.jfif" alt="Fairy Meadows">

    <div class="card-content">

        <span class="rating">
            ⭐ 4.9
        </span>

        <h3>Fairy Meadows</h3>

        <p><i class="fas fa-location-dot"></i> Gilgit Baltistan</p>

        <div class="card-bottom">

            <span class="price">
                From <strong>Rs. 25,000</strong>
            </span>

           <button class="explore-btn" onclick="openDestination('Fairy Meadows')">
    Explore
</button>

        </div>

    </div>

</div>

       <div class="destination-card">

    <img src="images/destination/swat.webp" alt="Swat">

    <div class="card-content">

        <span class="rating">
            ⭐ 4.8
        </span>

        <h3>Swat</h3>

        <p><i class="fas fa-location-dot"></i> Khyber Pakhtunkhwa</p>

        <div class="card-bottom">

            <span class="price">
                From <strong>Rs. 17,000</strong>
            </span>

            <button class="explore-btn" onclick="openDestination('Swat')">
    Explore
</button>

        </div>

    </div>

</div>

    </div>

</section>

<!-- ================= DESTINATIONS SECTION END ================= -->

<!-- ==========================
     TOUR CATEGORIES
========================== -->

<section class="categories" id="categories">

    <div class="section-title">
        <p>Tour Categories</p>
        <h2>Find Your Perfect Journey</h2>
    </div>

    <div class="category-grid">

        <!-- Luxury -->
        <a href="tour-categories/luxury-tour.php" class="category-card">

            <img src="images/categories/luxury.jfif" alt="Luxury Tours">

            <div class="category-overlay">

                <span>Premium Collection</span>

                <h3>Luxury Tours</h3>

                <p>Luxury hotels, private transport and unforgettable experiences.</p>

            </div>

        </a>

        <!-- Adventure -->
        <a href="tour-categories/adventure-tour.php" class="category-card">

            <img src="images/categories/adventure.jfif" alt="Adventure Tours">

            <div class="category-overlay">

                <span>Thrilling</span>

                <h3>Adventure Tours</h3>

                <p>Mountain trekking, camping, jeep safaris and outdoor adventures.</p>

            </div>

        </a>

        <!-- Family -->
        <a href="tour-categories/family-tours.php" class="category-card">

            <img src="images/categories/family.jfif" alt="Family Tours">

            <div class="category-overlay">

                <span>Family Friendly</span>

                <h3>Family Tours</h3>

                <p>Comfortable holidays designed for families of all sizes.</p>

            </div>

        </a>

        <!-- Cultural -->
        <a href="tour-categories/cultural-tours.php" class="category-card">

            <img src="images/categories/cultural.jfif" alt="Cultural Tours">

            <div class="category-overlay">

                <span>Heritage</span>

                <h3>Cultural Tours</h3>

                <p>Discover Pakistan's rich history, traditions and heritage.</p>

            </div>

        </a>

        <!-- Winter -->
        <a href="tour-categories/winter-tours.php" class="category-card">

            <img src="images/categories/winter.jfif" alt="Winter Tours">

            <div class="category-overlay">

                <span>Snow Adventures</span>

                <h3>Winter Tours</h3>

                <p>Experience snowy mountains, skiing and magical winter landscapes.</p>

            </div>

        </a>

    </div>

</section>

<!--================ BOOKING SECTION ================-->

<section id="booking" class="booking-section hidden-booking">

    <div class="booking-header">
        <h2>Book Your Dream Tour</h2>
        <p>
            Fill out the form below and our travel experts will contact you shortly.
        </p>
    </div>

    <div class="booking-container">

    <?php
if(isset($_GET['booking']) && $_GET['booking']=="success"){
    echo "<p class='success-message'>✅ Your booking has been submitted successfully. Please check your email.</p>";
}
?>

        <form action="php/booking.php" method="POST" class="booking-form">

            <div class="input-box">
                <label>Full Name</label>
                <input type="text" name="full_name" placeholder="Enter your full name" required>
            </div>

            <div class="input-box">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="input-box">
                <label>Phone Number</label>
                <input type="text" name="phone" placeholder="03XX-XXXXXXX" required>
            </div>

            <div class="input-box">
                <label>Destination</label>
                <input
type="text"
id="destination"
name="destination"
value="<?php echo isset($_GET['destination']) ? htmlspecialchars($_GET['destination']) : ''; ?>">
            </div>

            <div class="input-box">
                <label>Number of Persons</label>
                <input type="number" name="persons" min="1" max="20" required>
            </div>

            <div class="input-box">
                <label>Travel Date</label>
                <input type="date" name="travel_date" required>
            </div>

            <div class="input-box full-width">
                <label>Special Request</label>
                <textarea name="special_request" rows="5" placeholder="Tell us about your requirements..."></textarea>
            </div>

            <div class="full-width">
                <button type="submit" name="book" class="booking-btn">
                    Book Tour
                </button>
            </div>

            <div class="booking-close">
    <span onclick="closeBooking()">&times;</span>
</div>

        </form>

    </div>

</section>

<!-- ================= WHY CHOOSE US START ================= -->

<section class="why-us">

    <div class="section-title">
        <p>Why Choose Us</p>
        <h2>We Make Every Journey Special</h2>
    </div>

    <div class="why-container">

        <div class="why-card">

            <i class="fas fa-map-marked-alt"></i>

            <h3>Best Destinations</h3>

            <p>
                Discover Pakistan's most beautiful valleys,
                mountains and historical places.
            </p>

        </div>

        <div class="why-card">

            <i class="fas fa-hotel"></i>

            <h3>Luxury Hotels</h3>

            <p>
                Stay in premium hotels with comfort,
                safety and excellent hospitality.
            </p>

        </div>

        <div class="why-card">

            <i class="fas fa-user-shield"></i>

            <h3>Safe Travel</h3>

            <p>
                Your safety is our priority with
                experienced guides and secure tours.
            </p>

        </div>

        <div class="why-card">

            <i class="fas fa-headset"></i>

            <h3>24/7 Support</h3>

            <p>
                Our support team is available anytime
                before and during your journey.
            </p>

        </div>

    </div>

</section>

<!-- ================= WHY CHOOSE US END ================= -->

<!-- ================= FEATURED PACKAGES START ================= -->

<section class="packages" id="packages">

    <div class="section-title">
        <p>Tour Packages</p>
        <h2>Choose Your Perfect Adventure</h2>
    </div> 

    <div id="searchResult" class="search-result"></div>

    <div class="package-grid">

       <?php while($row = mysqli_fetch_assoc($result)){ ?>

<div class="package-card">

<?php if(!empty($row['badge'])){ ?>
    <div class="package-badge
<?php
if($row['badge']=="Best Seller"){
    echo "badge-best";
}
elseif($row['badge']=="Popular"){
    echo "badge-popular";
}
elseif($row['badge']=="New"){
    echo "badge-new";
}
elseif($row['badge']=="Recommended"){
    echo "badge-recommended";
}
?>">
    <?php echo $row['badge']; ?>
</div>
<?php } ?>

    <img src="images/packages/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>">

    <div class="package-content">

        <span class="days">
            <?php echo $row['duration']; ?>
        </span>

        <h3><?php echo $row['title']; ?></h3>

        <div class="package-rating">

    <div class="rating-left">
        <i class="fas fa-star"></i>
        <span><?php echo $row['rating']; ?></span>
    </div>

    <div class="rating-right">
        <?php echo $row['reviews']; ?> Reviews
    </div>

</div>

<p class="package-location">
    <i class="fas fa-location-dot"></i>
    <?php echo $row['destination']; ?>
</p>

        <p>
            <?php echo $row['description']; ?>
        </p>

        <div class="package-info">

            <span><i class="fas fa-hotel"></i> Hotel</span>

            <span><i class="fas fa-bus"></i> Transport</span>

            <span><i class="fas fa-utensils"></i> Meals</span>

        </div>

        <div class="package-footer">

            <div>

                <small>Starting From</small>

                <h4>Rs. <?php echo $row['price']; ?></h4>

            </div>

           <button
class="btn-book"
onclick="openBooking('<?php echo htmlspecialchars($row['destination']); ?>')">

Book Now

</button>

        </div>

    </div>

</div>

<?php } ?>
                </div>

</section>

<!-- ================= FEATURED PACKAGES END ================= -->

<!-- ================= STATS SECTION START ================= -->

<section class="stats">

    <div class="stats-container">

        <div class="stat-box">
            <i class="fas fa-users"></i>
            <h2>10K+</h2>
            <p>Happy Travelers</p>
        </div>

        <div class="stat-box">
            <i class="fas fa-map"></i>
            <h2>500+</h2>
            <p>Tours Completed</p>
        </div>

        <div class="stat-box">
            <i class="fas fa-mountain"></i>
            <h2>50+</h2>
            <p>Top Destinations</p>
        </div>

        <div class="stat-box">
            <i class="fas fa-star"></i>
            <h2>98%</h2>
            <p>Customer Satisfaction</p>
        </div>

    </div>

</section>

<!-- ================= STATS SECTION END ================= -->

<!-- ================= GALLERY SECTION START ================= -->

<section class="gallery" id="gallery">

    <div class="section-title">
        <p>Travel Gallery</p>
        <h2>Moments You'll Never Forget</h2>
    </div>

    <div class="gallery-grid">

    <!-- Featured Image -->
    <div class="gallery-item featured">
        <img src="images/gallery/hunza passu cones.jpg" alt="Passu Cones">
        <div class="gallery-overlay">
            <div>
                <h3>📍 Passu Cones</h3>
                <p>Hunza Valley</p>
            </div>
        </div>
    </div>

    <!-- Small Cards -->
    <div class="gallery-item">
        <img src="images/gallery/skardu deosai national park.webp" alt="Deosai">
        <div class="gallery-overlay">
            <div>
                <h3>📍 Deosai</h3>
                <p>Skardu</p>
            </div>
        </div>
    </div>

    <div class="gallery-item">
        <img src="images/gallery/fairy meadows nanga parbat.webp" alt="Nanga Parbat">
        <div class="gallery-overlay">
            <div>
                <h3>📍 Nanga Parbat</h3>
                <p>Fairy Meadows</p>
            </div>
        </div>
    </div>

    <div class="gallery-item">
        <img src="images/gallery/neelum areng kel.jpg" alt="Arang Kel">
        <div class="gallery-overlay">
            <div>
                <h3>📍 Arang Kel</h3>
                <p>Neelum Valley</p>
            </div>
        </div>
    </div>

    <div class="gallery-item">
        <img src="images/gallery/swat malam jabba.JPG" alt="Malam Jabba">
        <div class="gallery-overlay">
            <div>
                <h3>📍 Malam Jabba</h3>
                <p>Swat Valley</p>
            </div>
        </div>
    </div>

    <div class="gallery-item">
        <img src="images/gallery/saifulmalook.jpg" alt="Saif ul Malook">
        <div class="gallery-overlay">
            <div>
                <h3>📍 Saif ul Malook</h3>
                <p>Naran Kaghan</p>
            </div>
        </div>
    </div>

    <div class="gallery-item">
        <img src="images/gallery/shograan.jpg" alt="Shogran">
        <div class="gallery-overlay">
            <div>
                <h3>📍 Shogran</h3>
                <p>Kaghan Valley</p>
            </div>
        </div>
    </div>

    <div class="gallery-item">
        <img src="images/gallery/Babusar Top.jpg" alt="Babusar Top">
        <div class="gallery-overlay">
            <div>
                <h3>📍 Babusar Pass</h3>
                <p>Naran Kaghan</p>
            </div>
        </div>
    </div>

</div>

    </div>

</section>

<!-- ================= GALLERY SECTION END ================= -->

<!-- ================= TESTIMONIALS START ================= -->

<section class="testimonials" id="reviews">

    <div class="section-title">
        <p>Testimonials</p>
        <h2>What Our Travelers Say</h2>
    </div>

    <div class="testimonial-container">

        <!-- Testimonial 1 -->
        <div class="testimonial-card">

            <img src="images/testimonials/testimonial1.jpg" alt="Client 1">

            <h3>Ali Hassan</h3>

            <span>Lahore, Pakistan</span>

            <div class="stars">
                ⭐⭐⭐⭐⭐
            </div>

            <p>
                "Our Hunza trip was unforgettable. Everything was perfectly managed,
                from hotels to transportation. Highly recommended!"
            </p>

        </div>

        <!-- Testimonial 2 -->
        <div class="testimonial-card">

            <img src="images/testimonials/testimonial2.webp" alt="Client 2">

            <h3>Ayesha Khan</h3>

            <span>Islamabad, Pakistan</span>

            <div class="stars">
                ⭐⭐⭐⭐⭐
            </div>

            <p>
                "Professional guides, comfortable hotels and amazing destinations.
                I can't wait to travel again!"
            </p>

        </div>

        <!-- Testimonial 3 -->
        <div class="testimonial-card">

            <img src="images/testimonials/testimonial03.avif" alt="Client 3">

            <h3>Usman Ali</h3>

            <span>Karachi, Pakistan</span>

            <div class="stars">
                ⭐⭐⭐⭐⭐
            </div>

            <p>
                "Excellent customer service and affordable packages.
                The Skardu tour exceeded all my expectations."
            </p>

        </div>

    </div>

</section>

<!-- ================= TESTIMONIALS END ================= -->

<!-- ================= CTA SECTION START ================= -->

<section class="cta">

    <div class="cta-overlay">

        <h2>Ready to Explore Pakistan?</h2>

        <p>
            Book your dream vacation today and experience
            breathtaking mountains, lakes, valleys, and unforgettable adventures.
        </p>

       <a href="javascript:void(0)" class="btn-book"
   onclick="openBooking()">
    Book Now
</a>
    </div>

</section>

<!-- ================= CTA SECTION END ================= -->

<!-- ================= CONTACT SECTION START ================= -->

<section class="contact" id="contact">

    <div class="section-title">
        <p>Contact Us</p>
        <h2>Plan Your Next Adventure</h2>
    </div>

    <div class="contact-container">

        <!-- Contact Information -->
        <div class="contact-info">

            <h3>Get In Touch</h3>

            <p>
                We'd love to help you plan your perfect trip.
                Contact us anytime.
            </p>

            <div class="info-box">
                <i class="fas fa-map-marker-alt"></i>
                <span>Wazirabad, Pakistan</span>
            </div>

            <div class="info-box">
                <i class="fas fa-phone"></i>
                <span>+92 300 1234567</span>
            </div>

            <div class="info-box">
                <i class="fas fa-envelope"></i>
                <span>info@explorepakistan.com</span>
            </div>

            <div class="social-icons">

                <a href="#"><i class="fab fa-facebook-f"></i></a>

                <a href="#"><i class="fab fa-instagram"></i></a>

                <a href="#"><i class="fab fa-twitter"></i></a>

                <a href="#"><i class="fab fa-youtube"></i></a>

            </div>

        </div>

        <!-- Contact Form -->

    <?php
    if(isset($_GET['status']) && $_GET['status']=="success"){
        echo "<p class='success-message'>✅ Your message has been sent successfully!</p>";
    }
    ?>

    <form action="php/contact.php" method="POST" class="contact-form">

...

        <form action="php/contact.php" method="POST" class="contact-form">

    <input
        type="text"
        name="full_name"
        placeholder="Your Name"
        required
    >

    <input
        type="email"
        name="email"
        placeholder="Your Email"
        required
    >

    <input
        type="text"
        name="subject"
        placeholder="Subject"
    >

    <textarea
        name="message"
        rows="6"
        placeholder="Your Message"
        required
    ></textarea>

    <button type="submit" name="send">
        Send Message
    </button>

</form>

</section>

<!-- ================= CONTACT SECTION END ================= -->

<!-- ================= FOOTER START ================= -->

<footer class="footer">

    <div class="footer-container">

        <!-- Column 1 -->
        <div class="footer-box">

            <h2>Explore Pakistan</h2>

            <p>
                Discover breathtaking mountains, peaceful valleys,
                crystal-clear lakes, and unforgettable adventures across Pakistan.
            </p>

        </div>

        <!-- Column 2 -->
        <div class="footer-box">

            <h3>Quick Links</h3>

            <ul>

                <li><a href="#home">Home</a></li>

                <li><a href="#destinations">Destinations</a></li>

                <li><a href="#packages">Packages</a></li>

                <li><a href="#gallery">Gallery</a></li>

                <li><a href="#contact">Contact</a></li>

            </ul>

        </div>

        <!-- Column 3 -->
        <div class="footer-box">

            <h3>Popular Destinations</h3>

            <ul>

                <li>Hunza Valley</li>

                <li>Skardu</li>

                <li>Fairy Meadows</li>

                <li>Swat Valley</li>

                <li>Neelum Valley</li>

            </ul>

        </div>

        <!-- Column 4 -->

        <div class="footer-box">

            <h3>Contact Info</h3>

            <p><i class="fas fa-map-marker-alt"></i> Wazirabad, Pakistan</p>

            <p><i class="fas fa-phone"></i> +92 300 1234567</p>

            <p><i class="fas fa-envelope"></i> info@explorepakistan.com</p>

            <div class="footer-social">

                <a href="#"><i class="fab fa-facebook-f"></i></a>

                <a href="#"><i class="fab fa-instagram"></i></a>

                <a href="#"><i class="fab fa-twitter"></i></a>

                <a href="#"><i class="fab fa-youtube"></i></a>

            </div>

        </div>

    </div>

    <div class="footer-bottom">

        <p>
            © 2026 Explore Pakistan. All Rights Reserved.
        </p>

    </div>

</footer>

<!-- ================= FOOTER END ================= -->

    <!-- ================= BACK TO TOP BUTTON ================= -->

<button id="backToTop">
    <i class="fas fa-arrow-up"></i>
</button>

<!--========== DESTINATION MODAL ==========-->

<div class="destination-modal" id="destinationModal">

    <div class="modal-content">

        <span class="close-btn" onclick="closeModal()">&times;</span>

        <img id="modalImage" src="" alt="Destination">

        <h2 id="modalTitle"></h2>

        <h3>📖 Description</h3>
        <p id="modalDescription"></p>

        <h3>🌸 Best Time to Visit</h3>
        <p id="modalBestTime"></p>

        <h3>🌤 Weather</h3>
        <p id="modalWeather"></p>

        <h3>⭐ Top Attractions</h3>

        <ul id="modalAttractions"></ul>

    </div>

</div>

  <script src="script.js?v=20261027"></script>

  <script>

window.onload = function(){

    const params = new URLSearchParams(window.location.search);

    if(params.has("destination")){

        const booking = document.getElementById("booking");

        booking.style.display = "block";

        booking.scrollIntoView({

            behavior:"smooth"

        });

    }

};

</script>

<!-- Video Popup -->

<div id="videoPopup" class="video-popup">

    <div class="video-box">

        <span class="close-video" onclick="closeVideo()">&times;</span>

        <iframe
            id="youtubeVideo"
            src=""
            title="Pakistan Tourism"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
        </iframe>

    </div>

</div>

</body>

</html>