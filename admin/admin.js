const searchInput = document.getElementById("searchBooking");

if(searchInput){

    searchInput.addEventListener("keyup", function(){

        let filter = this.value.toLowerCase();

        let rows = document.querySelectorAll("#bookingTable tbody tr");

        rows.forEach(function(row){

            let name = row.cells[1].innerText.toLowerCase();

            let destination = row.cells[4].innerText.toLowerCase();

            if(name.includes(filter) || destination.includes(filter)){

                row.style.display = "";

            }else{

                row.style.display = "none";

            }

        });

    });

}

const togglePassword = document.getElementById("togglePassword");

if(togglePassword){

togglePassword.addEventListener("click",function(){

const password=document.getElementById("password");

if(password.type==="password"){

password.type="text";

this.classList.remove("fa-eye");

this.classList.add("fa-eye-slash");

}else{

password.type="password";

this.classList.remove("fa-eye-slash");

this.classList.add("fa-eye");

}

});

}