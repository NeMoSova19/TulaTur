document.addEventListener("DOMContentLoaded", function() { 
    var btn_like = document.querySelector('.btn_like');
    var btn_dislike = document.querySelector('.btn_dislike');

    btn_like.addEventListener("click", function() {
        var link = $(this);
        var id = link.data('id');
        
        $.post('/php_scripts/like.php', {id: id}, 
        function(data){
            if(data.active){
                $('.ico_like', link).css('fill', '#198754')
                $('.ico_dislike', $(btn_dislike)).css('fill', 'currentColor')
            }
            else{
                $('.ico_like', link).css('fill', 'currentColor')
            }
            $('.counter_like', link).html(data.like);
            $('.counter_dislike', $(btn_dislike)).html(data.dislike);
        });
    });


    btn_dislike.addEventListener("click", function() {
        var link = $(this);
        var id = link.data('id');
        $.post('/php_scripts/dislike.php', {id: id}, 
        function(data){
            if(data.active){
                $('.ico_dislike', link).css('fill', '#dc3545')
                $('.ico_like', $(btn_like)).css('fill', 'currentColor')
            }
            else{
                $('.ico_dislike', link).css('fill', 'currentColor')
            }
            $('.counter_dislike', link).html(data.dislike);
            $('.counter_like', $(btn_like)).html(data.like);
        });
    });
});