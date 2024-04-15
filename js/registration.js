document.addEventListener("DOMContentLoaded", function() { 
    var request;
    
    $("#form-login").submit(function(event){
        
        event.preventDefault();
        
        if (request) {
            request.abort();
        }
        
        var $form = $(this);
        
        var $inputs = $form.find("input, select, button, textarea");
        
        var serializedData = $form.serialize();
        
        $inputs.prop("disabled", true);
        
        $.post('/php_scripts/registration.php', serializedData, 
        function(response) {
            var error_form = document.querySelector('.error-message');
            switch (response.error) {
                case 'OK':
                    window.location.href = '/php_scripts/back_to_save_loc.php'; 
                    return;
            
                case 'UserAlreadyExists':
                    var err_msg = "<div class='alert alert-danger' role='alert'>";
                    err_msg += "Пользователь уже существует";
                    err_msg += "</div>";
                    $(error_form).html(err_msg);
                    break;
                    
                case 'InvalidPassword':
                    var err_msg = "<div class='alert alert-danger' role='alert'>";
                    err_msg += "Пароль должен быть не менее 8 символов <br>Пароль должен содержать не менее 1 прописной буквы<br>Пароль должен содержать не менее 1 цифры";
                    err_msg += "</div>";
                    $(error_form).html(err_msg);
                    break;

                case 'NotEqualPasswords':
                    var err_msg = "<div class='alert alert-danger' role='alert'>";
                    err_msg += "Пароли должны быть одинаковыми";
                    err_msg += "</div>";
                    $(error_form).html(err_msg);
                    break;
            }
        });
        $inputs.removeAttr('checked').removeAttr('selected').removeAttr('disabled');
    });
});