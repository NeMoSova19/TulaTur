document.addEventListener("DOMContentLoaded", function() { 
    var btn_favorites = document.querySelector('.js_favorites');
    var btn_trips = document.querySelector('.js_trips');
    var btns = document.querySelector('.btn-action');

    btn_favorites.addEventListener("click", function() {
        var link = $(this);
        var id = link.data('id');
        
        $.post('/php_scripts/favorites.php', {id: id}, 
        function(data){
            if(data.result){
                $('.js_favorites', $(btns)).css('background-color', '#dc3545');
                $('.js_favorites', $(btns)).css('color', '#ffffff');
                $('.js_trips', $(btns)).css('background-color', 'transparent');
                $('.js_trips', $(btns)).css('color', '#198754');
            }
            else{
                $('.js_favorites', $(btns)).css('background-color', 'transparent');
                $('.js_favorites', $(btns)).css('color', '#dc3545');
            }
        });
    });
    

    btn_trips.addEventListener("click", function() {
        var link = $(this);
        var id = link.data('id');
        console.log("clk");
        $.post('/php_scripts/trips.php', {id: id}, 
        function(data){
            if(data.result){
                $('.js_trips', $(btns)).css('background-color', '#198754');
                $('.js_trips', $(btns)).css('color', '#ffffff');
                $('.js_favorites', $(btns)).css('background-color', 'transparent');
                $('.js_favorites', $(btns)).css('color', '#dc3545');
            }
            else{
                $('.js_trips', $(btns)).css('background-color', 'transparent');
                $('.js_trips', $(btns)).css('color', '#198754');
            }
        });
    });
});