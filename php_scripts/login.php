<?php
include("../tulatur.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = $_POST['login'];
    $password = $_POST['password'];
    
    TulaTur::Connect();
    $result = TulaTur::VerifyUser($username, $password);
    TulaTur::Disconnect();

    $error;
    
    switch ($result) {
        case 'OK':
            $_SESSION['login'] = $_POST['login'];
            $error = 'OK';
            break;
            
        case 'User not found':
            $error = "UserNotFound";
            break;

        case 'Password incorrect':
            $error = "PasswordIncorrect";
            break;
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