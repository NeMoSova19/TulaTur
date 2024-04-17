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
                    err_msg += "Пароль должен сожержать:<lu><li>Не менее 1 прописной буквы</li><li>Не менее 1 цифры</li></lu>Длина от 8 до 32 символов";
                    err_msg += "</div>";
                    $(error_form).html(err_msg);
                    break;

                case 'InvalidUser':
                    var err_msg = "<div class='alert alert-danger' role='alert'>";
                    err_msg += "Имя пользователя может содержать:<lu><li>Буквы из кириллицы и латинского алфавитов</li><li>Любые цифры</li><li>Символы -_.</li></lu>Длина от 3 до 32 символов";
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