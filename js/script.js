document.addEventListener("DOMContentLoaded", function() { 
    
    var dayTourUnder = document.querySelector('.day-under');
    console.log(dayTourUnder);
    dayTourUnder.classList.add('day_tour');

    var nightButton = document.querySelector(".night-type");
    var dayButton = document.querySelector(".day-type");
    var resetTagsButton = document.querySelector(".reset-tags");

    var imgNight = document.querySelector(".img-night");
    var imgDay = document.querySelector(".img-day");

    var formNight = document.querySelector(".main_app_background");
    var textNight = document.querySelectorAll(".names_of_items");
    var descNight = document.querySelectorAll(".description_of_items");
    var backgroundSection = document.querySelector(".section_background");

    var buttonSwitch = document.querySelectorAll('.day_tour_text');

    var nightTourUnder = document.querySelector('.night_under');
    var mainBlock = document.querySelector('main')
    var bodyBlock = document.querySelector('body')
    var headerBlock = document.querySelector('header')

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
        bodyBlock.style.backgroundColor = "#0b0114";
        headerBlock.style.backgroundColor = "#fff";

    });

    dayButton.addEventListener("click", function() {
        // location.reload();
        imgDay.style.display = "block";
        imgNight.style.display = "none";
        // formNight.classList.add('night_type');
        formNight.classList.remove('night_type');

        textNight.forEach(element => {
            element.classList.remove('night_text');
        });
        
        descNight.forEach(element => {
            element.classList.remove('night_text');
        });

        buttonSwitch.forEach(element => {
            element.style.color ="#000"
        });

        backgroundSection.style.backgroundColor = "#FBFAE2";
        backgroundSection.style.boxShadow = "0px -55px 150px 150px #FBFAE2";

        nightTourUnder.classList.remove('day_tour');
        dayTourUnder.classList.add('day_tour');
        bodyBlock.style.backgroundColor = "#fbfae2";

        headerBlock.style.backgroundColor = "#fff";

    });
    

    resetTagsButton.addEventListener('click', function(){
        window.location.href = '/php_scripts/reset-tags.php'; 
        return;
    });

});