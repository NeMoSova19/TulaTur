document.addEventListener("DOMContentLoaded", function() { 
    var loginButton = document.getElementById("loginButton"); 

    loginButton.addEventListener("click", function() { 

        $.post('/php_scripts/log_or_out.php', 
        function(response) {
            if(response == 'log'){
                window.location.href = '/login-form.php'; 
            }
            else{
                window.location.href = '/php_scripts/logout.php'; 
            }
        });     
    });
});