document.addEventListener("DOMContentLoaded", function() { 
    var loginButton = document.getElementById("loginButton"); 

    loginButton.addEventListener("click", function() { 
        var buttonText = loginButton.innerText.trim(); 
        console.log("okoko");
        if (buttonText === 'Войти') { 
            window.location.href = 'login-form.php'; 
            return;
        }
        window.location.href = 'logout.php'; 
     
    });
});