<?php
  session_start();
  $error_message = isset($_SESSION['error']) ? $_SESSION['error'] : '';
  unset($_SESSION['error']); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/authorization.css">
    <link rel="stylesheet" href="/css/adaptive_login-form.css">
    <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/css/header.css" type="text/css">
    <script src="/js/login.js"></script>
</head>

<body class="background-login">
    <div class="container-login">
    <button id="btn_back" class="btn_back"><img class="btn_back_img" src="img/btn_back.png" alt="Back"></button>
        <form class="form-login" id="form-login">
            <p сlass="authorization-title">Войти</p>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Логин</label>
              <div class="input-login">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                  </svg>
                  <input name="login" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" autocomplete="on">
              </div>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Пароль</label>
              <div class="input-login">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/>
                  </svg>
                  <input name="password" type="password" class="form-control" id="exampleInputPassword1" autocomplete="on">
              </div>
            </div>
            <div class="mb-3">
                <div class="error-message">
                  <!-- error msg -->
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-login">Войти</button>
            <div class="form-action">
              <span>Еще нет аккаунта?</span><a href="/registration-form.php" class="login-link">Зарегистрироваться</a>
            </div>
        </form>
    </div>
    <script>
      var errorMessage = document.querySelector('.error-message');
      var myButton = document.querySelector('.btn-registration');
      var paddingButton = document.querySelector('.background-login');
      if (errorMessage && errorMessage.textContent.trim() !== '') {
        myButton.style.marginTop = '0';
        paddingButton.style.paddingTop = '5%';
      }
    </script>
</body>
</html>