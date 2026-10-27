/* ===================================
   UPCOMING TRIP DETAILS JAVASCRIPT
=================================== */



/* ===================================
   DEPARTURE DATE SELECTION
=================================== */


function selectDeparture(button, date){


    // Remove active from all cards

    document.querySelectorAll(".departure-card")
    .forEach(card=>{

        card.classList.remove("active");

    });



    // Add active to selected card

    button.parentElement.classList.add("active");



    // Update hidden booking date

    let dateInput =
    document.getElementById("departureDate");


    if(dateInput){

        dateInput.value = date;

    }



    console.log(
        "Selected Departure:",
        date
    );


}







/* ===================================
   ACCORDION SYSTEM
=================================== */


document.addEventListener(
"DOMContentLoaded",
function(){



const accordionTitles =
document.querySelectorAll(".accordion-title");



accordionTitles.forEach(title=>{


    title.addEventListener(
    "click",
    function(){



        let content =
        this.nextElementSibling;



        if(content){


            content.classList.toggle(
                "show"
            );



            let icon =
            this.querySelector("span");



            if(icon){


                if(
                content.classList.contains("show")
                ){

                    icon.innerHTML="-";

                }

                else{

                    icon.innerHTML="+";

                }


            }


        }



    });



});



});