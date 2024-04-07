document.addEventListener("DOMContentLoaded", function() { 
    var loginButton = document.getElementById("loginButton"); 

    loginButton.addEventListener("click", function() { 
        var buttonText = loginButton.innerText.trim(); 
        console.log("okoko");
        if (buttonText === 'Войти') { 
            window.location.href = 'login.html'; 
            return;
        }
        window.location.href = 'logout.php'; 
     
    }); 
    var dayTourUnder = document.querySelector('.day-under');
    console.log(dayTourUnder);
    dayTourUnder.classList.add('day_tour');

    var nightButton = document.querySelector(".night-type");
    var dayButton = document.querySelector(".day-type");

    var imgNight = document.querySelector(".img-night");
    var imgDay = document.querySelector(".img-day");

    var formNight = document.querySelector(".main_app_background");
    var textNight = document.querySelectorAll(".names_of_items");
    var descNight = document.querySelectorAll(".description_of_items");
    var backgroundSection = document.querySelector(".section_background");

    var buttonSwitch = document.querySelectorAll('.day_tour_text');

    var nightTourUnder = document.querySelector('.night_under');

    nightButton.addEventListener("click", function() {
        imgDay.style.display = "none";
        imgNight.style.display = "block";
        formNight.classList.add('night_type');

        textNight.forEach(element => {
            element.classList.add('night_text');
        });
        
        descNight.forEach(element => {
            element.classList.add('night_text');
        });

        buttonSwitch.forEach(element => {
            element.style.color ="#fff"
        });

        backgroundSection.style.backgroundColor = "#0B0114";
        backgroundSection.style.boxShadow = "0px -55px 150px 150px #0B0114";

        nightTourUnder.classList.add('day_tour');
        dayTourUnder.classList.remove('day_tour');
        console.log(nightTourUnder);

    });
    
});