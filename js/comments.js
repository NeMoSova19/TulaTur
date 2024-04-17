document.addEventListener("DOMContentLoaded", function() { 

    $("#form-send-message").submit(function(event){

        event.preventDefault();

        var $form = $(this);
        var id = $(this).data('id');
        var com = document.getElementById('comment-input').value;


        $.post('/php_scripts/comment.php', {id:id, comment:com},
        function(response) {
            console.log(response.error);
            var error_form = document.querySelector('.error-message');
        });
    });
});