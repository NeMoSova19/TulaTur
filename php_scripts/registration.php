<?php
include("../tulatur.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = $_POST['login'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    
    
    $error;
    
    if($password1 == $password2){
        TulaTur::Connect();
        $result = TulaTur::TryRegisterNewUser($username, $password1);
        TulaTur::Disconnect();


        switch ($result) {
            case 'OK':
                $_SESSION['login'] = $_POST['login'];
                $error = 'OK';
                break;
                
            case 'User already exists':
                $error = "UserAlreadyExists";
                break;

            case 'Invalid password':
                $error = "InvalidPassword";
                break;
        }
    }
    else{
        $error = "NotEqualPasswords";
    }
    
    $out = array(
        'error' => $error,
    );
    
    // Устанавливаем заголовок ответа в формате json
    header('Content-Type: text/json; charset=utf-8');
    
    // Кодируем данные в формат json и отправляем
    echo json_encode($out);

}
?>