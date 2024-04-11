document.addEventListener("DOMContentLoaded", function() { 
    var loginButton = document.getElementById("loginButton"); 

    loginButton.addEventListener("click", function() { 
        var buttonText = loginButton.innerText.trim(); 
        
        if (buttonText === 'Войти') { 
            window.location.href = 'login-form.php'; 
            return;
        }
        window.location.href = '/php_scripts/logout.php'; 
     
    });
});