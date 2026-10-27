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

<section class="destination-intro">

    <div class="destination-intro-content">

        <span>DISCOVER PAKISTAN</span>

        <h1>Explore Our Destinations</h1>

        <p>
            Pakistan is home to some of the world's most breathtaking landscapes,
            from towering mountains and crystal-clear lakes to lush green valleys
            and rich cultural heritage. Discover our handpicked destinations and
            begin your next unforgettable adventure.
        </p>

    </div>

</section>

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

    <img src="images/destination/naran kaghan.avif" alt="Naran kaghan">

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

<!-- Destination Modal -->

<div id="destinationModal" class="destination-modal">

    <div class="modal-content">

        <span class="close-btn" onclick="closeModal()">&times;</span>

        <img id="modalImage" src="" alt="">

        <h2 id="modalTitle"></h2>

        <p id="modalDescription"></p>

        <div class="modal-details">

            <div class="detail-box">
                <h4>Best Time</h4>
                <p id="modalBestTime"></p>
            </div>

            <div class="detail-box">
                <h4>Weather</h4>
                <p id="modalWeather"></p>
            </div>

        </div>

        <h3>Top Attractions</h3>

        <ul id="modalAttractions"></ul>

    </div>

</div>

<section class="destination-cta">

    <div class="cta-content">

        <h2>Ready to Explore Pakistan?</h2>

        <p>
            Every destination has its own story. From the majestic peaks of the north
            to peaceful valleys and breathtaking lakes, your next unforgettable
            adventure begins here.
        </p>

        <a href="index.php#packages" class="cta-btn">
            Explore Our Tours
        </a>

    </div>

</section>

<script src="destination.js"></script>

</body>

</html>