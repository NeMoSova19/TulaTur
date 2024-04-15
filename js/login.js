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

        $.post('/php_scripts/login.php', serializedData, 
        function(response) {
            var error_form = document.querySelector('.error-message');
            switch (response.error) {
                case 'OK':
                    window.location.href = '/php_scripts/back_to_save_loc.php'; 
                    return;
            
                case 'UserNotFound':
                    var err_msg = "<div class='alert alert-danger' role='alert'>";
                    err_msg += "Пользователь не найден";
                    err_msg += "</div>";
                    $(error_form).html(err_msg);
                    break;
                    
                case 'PasswordIncorrect':
                    var err_msg = "<div class='alert alert-danger' role='alert'>";
                    err_msg += "Неверный пароль";
                    err_msg += "</div>";
                    $(error_form).html(err_msg);
                    break;
            }
        });
        $inputs.removeAttr('checked').removeAttr('selected').removeAttr('disabled');
    });
});