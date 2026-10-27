// =======================================
// DESTINATION DATA
// =======================================

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

    "Neelum Valley": {
        image: "images/destination/neelum valley.jpg",
        title: "Neelum Valley",
        description: "A paradise in Azad Kashmir filled with rivers, forests, waterfalls and peaceful villages.",
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
        description: "One of Pakistan's most famous hill stations with alpine lakes, glaciers and breathtaking valleys.",
        bestTime: "May to September",
        weather: "Summer: 10°C - 25°C",
        attractions: [
            "Lake Saif-ul-Malook",
            "Babusar Top",
            "Lulusar Lake",
            "Kunhar River",
            "Siri Paye"
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

    "Swat": {
        image: "images/destination/swat.webp",
        title: "Swat Valley",
        description: "Known as the Switzerland of Pakistan, Swat offers rivers, waterfalls, forests, mountains and ski resorts.",
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
    }

};


// =======================================
// OPEN MODAL
// =======================================

function openDestination(place){

    const d = destinations[place];

    if(!d){
        console.error("Destination not found:", place);
        return;
    }

    document.getElementById("modalImage").src = d.image;
    document.getElementById("modalTitle").innerHTML = d.title;
    document.getElementById("modalDescription").innerHTML = d.description;
    document.getElementById("modalBestTime").innerHTML = d.bestTime;
    document.getElementById("modalWeather").innerHTML = d.weather;

    let list = "";

    d.attractions.forEach(function(item){

        list += "<li>" + item + "</li>";

    });

    document.getElementById("modalAttractions").innerHTML = list;

    document.getElementById("destinationModal").style.display = "flex";

}


// =======================================
// CLOSE MODAL
// =======================================

function closeModal(){

    document.getElementById("destinationModal").style.display = "none";

}


// =======================================
// CLOSE WHEN CLICKING OUTSIDE
// =======================================

window.onclick = function(event){

    const modal = document.getElementById("destinationModal");

    if(event.target == modal){

        closeModal();

    }

};