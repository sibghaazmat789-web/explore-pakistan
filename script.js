
"use strict";

console.log("Explore Pakistan script.js loaded successfully");

// ========================================
// MAIN NAVIGATION, STICKY NAVBAR & TOP BUTTON
// ========================================

function initializeWebsite() {
    const navbar = document.querySelector(".navbar");
    const topBtn = document.getElementById("backToTop");

    // Sticky navbar
    function updateNavbar() {
        if (navbar) {
            navbar.classList.toggle("sticky", window.scrollY > 80);
        }

        if (topBtn) {
            topBtn.style.display = window.scrollY > 300 ? "flex" : "none";
        }
    }

    window.addEventListener("scroll", updateNavbar, { passive: true });
    updateNavbar();

    // Back to top
    if (topBtn) {
        topBtn.addEventListener("click", function () {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    }
}



function initializeMobileMenu() {
    const menuBtn = document.querySelector(".menu-btn");
    const navLinks = document.querySelector(".nav-links");

    if (!menuBtn || !navLinks) return;

    menuBtn.addEventListener("click", function (event) {
        event.preventDefault();

        const isOpen = navLinks.classList.toggle("active");
        menuBtn.setAttribute("aria-expanded", String(isOpen));

        console.log("Mobile menu state:", isOpen);
    });

    navLinks.querySelectorAll("a").forEach(function (link) {
        link.addEventListener("click", function () {
            navLinks.classList.remove("active");
            menuBtn.setAttribute("aria-expanded", "false");
        });
    });
}

  
// ========================================
// DESTINATION DETAILS
// ========================================

const destinations = {
    "Hunza": {
        image: "images/destination/hunza valley.jpg",
        title: "Hunza Valley",
        description: "Hunza Valley is one of Pakistan's most beautiful mountain destinations, famous for its breathtaking scenery, crystal-clear lakes, and rich cultural heritage.",
        bestTime: "April to October",
        weather: "Summer: 15°C - 28°C | Winter: -10°C - 10°C",
        attractions: [
            "Attabad Lake",
            "Passu Cones",
            "Baltit Fort",
            "Altit Fort",
            "Khunjerab Pass",
            "Eagle's Nest"
        ]
    },

    "Skardu": {
        image: "images/destination/skardu.jpg",
        title: "Skardu",
        description: "Skardu is the gateway to the world's highest mountains and is famous for lakes, deserts, and adventurous trekking routes.",
        bestTime: "May to September",
        weather: "Summer: 12°C - 30°C | Winter: -15°C - 5°C",
        attractions: [
            "Shangrila Resort",
            "Upper Kachura Lake",
            "Satpara Lake",
            "Shigar Fort",
            "Deosai National Park",
            "Katpana Desert"
        ]
    },

    "Swat": {
        image: "images/destination/swat.webp",
        title: "Swat Valley",
        description: "Known as the Switzerland of Pakistan, Swat offers rivers, waterfalls, forests, mountains, and ski resorts.",
        bestTime: "March to October",
        weather: "Summer: 15°C - 30°C | Winter: -5°C - 8°C",
        attractions: [
            "Malam Jabba",
            "Kalam Valley",
            "Mahodand Lake",
            "Bahrain",
            "White Palace",
            "Fizagat Park"
        ]
    },

    "Fairy Meadows": {
        image: "images/destination/fairy meadows.jfif",
        title: "Fairy Meadows",
        description: "A peaceful alpine meadow at the base of Nanga Parbat with unforgettable mountain views.",
        bestTime: "May to September",
        weather: "Summer: 10°C - 25°C",
        attractions: [
            "Nanga Parbat View",
            "Camping",
            "Base Camp Trek",
            "Raikot Bridge"
        ]
    },

    "Neelum Valley": {
        image: "images/destination/neelum valley.jpg",
        title: "Neelum Valley",
        description: "A paradise in Azad Kashmir filled with rivers, forests, waterfalls, and peaceful villages.",
        bestTime: "April to October",
        weather: "Summer: 12°C - 27°C",
        attractions: [
            "Keran",
            "Sharda",
            "Kel",
            "Arang Kel",
            "Ratti Gali Lake"
        ]
    },

    "Naran Kaghan": {
        image: "images/destination/naran kaghan.avif",
        title: "Naran Kaghan",
        description: "One of Pakistan's most famous hill stations with alpine lakes, glaciers, and breathtaking valleys.",
        bestTime: "May to September",
        weather: "Summer: 10°C - 25°C",
        attractions: [
            "Lake Saif-ul-Malook",
            "Babusar Top",
            "Lulusar Lake",
            "Kunhar River",
            "Siri Paye"
        ]
    }
};

function openDestination(place) {
    const destination = destinations[place];

    if (!destination) {
        console.error("Destination not found:", place);
        return;
    }

    const image = document.getElementById("modalImage");
    const title = document.getElementById("modalTitle");
    const description = document.getElementById("modalDescription");
    const bestTime = document.getElementById("modalBestTime");
    const weather = document.getElementById("modalWeather");
    const attractions = document.getElementById("modalAttractions");
    const modal = document.getElementById("destinationModal");

    if (image) image.src = destination.image;
    if (title) title.textContent = destination.title;
    if (description) description.textContent = destination.description;
    if (bestTime) bestTime.textContent = destination.bestTime;
    if (weather) weather.textContent = destination.weather;

    if (attractions) {
        attractions.replaceChildren();

        destination.attractions.forEach(function (item) {
            const li = document.createElement("li");
            li.textContent = item;
            attractions.appendChild(li);
        });
    }

    if (modal) modal.style.display = "block";
}

function closeModal() {
    const modal = document.getElementById("destinationModal");
    if (modal) modal.style.display = "none";
}

// ========================================
// TOUR SEARCH
// ========================================

function searchTour() {
    const destinationInput = document.getElementById("destination");
    const checkinInput = document.getElementById("checkin");
    const guestsInput = document.getElementById("guests");

    if (!destinationInput || !checkinInput || !guestsInput) {
        console.error("Tour search fields were not found.");
        return;
    }

    const destination = destinationInput.value;
    const checkin = checkinInput.value;
    const guests = guestsInput.value;

    if (!destination || !checkin || !guests) {
        alert("Please fill all fields first.");
        return;
    }

    document.querySelectorAll(".package-card").forEach(function (card) {
        card.classList.remove("package-highlight");
    });

    const packageIds = {
        "Hunza Valley": "hunza-package",
        "Skardu": "skardu-package",
        "Swat Valley": "swat-package"
    };

    const packageId = packageIds[destination];

    if (!packageId) {
        const message = document.getElementById("searchMessage");

        if (message) {
            message.className = "search-message warning";
            message.textContent =
                "Tour packages for " + destination +
                " are coming soon. Please contact us for a custom tour.";
            message.style.display = "block";

            window.setTimeout(function () {
                message.style.display = "none";
            }, 4000);
        } else {
            alert("Packages for this destination are coming soon. Please contact us.");
        }

        return;
    }

    const packagesSection = document.getElementById("packages");
    const packageCard = document.getElementById(packageId);
    const result = document.getElementById("searchResult");

    if (packagesSection) {
        packagesSection.scrollIntoView({ behavior: "smooth" });
    }

    if (packageCard) {
        packageCard.classList.add("package-highlight");
    }

    if (result) {
        result.textContent =
            "Best package found for " + destination +
            ". Scroll below to book your tour.";
    }
}

// ========================================
// BOOKING
// ========================================

function openBooking(destination = "") {
    const booking = document.getElementById("booking");

    if (!booking) {
        console.error("Booking section was not found.");
        return;
    }

    booking.classList.remove("hidden-booking");
    booking.style.display = "block";
    booking.scrollIntoView({ behavior: "smooth" });

    if (destination) {
        // Prefer a dedicated booking field if available.
        const bookingDestination =
            document.getElementById("bookingDestination") ||
            booking.querySelector('[name="destination"]');

        if (bookingDestination) {
            bookingDestination.value = destination;
        }
    }
}

function closeBooking() {
    const booking = document.getElementById("booking");

    if (booking) {
        booking.style.display = "none";
    }
}

// ========================================
// HERO SLIDER
// ========================================

function initializeHeroSlider() {
    const heroSlides = document.querySelectorAll(".hero-slide");

    if (heroSlides.length < 2) return;

    let heroIndex = 0;

    window.setInterval(function () {
        heroSlides[heroIndex].classList.remove("active");

        heroIndex = (heroIndex + 1) % heroSlides.length;

        heroSlides[heroIndex].classList.add("active");
    }, 3000);
}

// ========================================
// YOUTUBE POPUP
// ========================================

function openVideo(event) {
    if (event) event.preventDefault();

    const popup = document.getElementById("videoPopup");
    const video = document.getElementById("youtubeVideo");

    if (popup) popup.style.display = "flex";

    if (video) {
        video.src =
            "https://www.youtube.com/embed/sUVp9DNQH6k?autoplay=1";
    }
}

function closeVideo() {
    const popup = document.getElementById("videoPopup");
    const video = document.getElementById("youtubeVideo");

    if (popup) popup.style.display = "none";
    if (video) video.src = "";
}

// ========================================
// INITIALIZE PAGE
// ========================================

document.addEventListener("DOMContentLoaded", function () {
    initializeWebsite();
    initializeMobileMenu();
    initializeHeroSlider();
    // Close destination modal when clicking its background
    const destinationModal = document.getElementById("destinationModal");

    if (destinationModal) {
        destinationModal.addEventListener("click", function (event) {
            if (event.target === destinationModal) {
                closeModal();
            }
        });
    }

    // Close YouTube popup when clicking its background
    const videoPopup = document.getElementById("videoPopup");

    if (videoPopup) {
        videoPopup.addEventListener("click", function (event) {
            if (event.target === videoPopup) {
                closeVideo();
            }
        });
    }
});
