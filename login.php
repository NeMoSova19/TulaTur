<?php
include("tulatur.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    TulaTur::Connect();

    $username = $_POST['login'];
    $password = $_POST['password'];

    $result = TulaTur::VerifyUser($username, $password);
    
    switch ($result) {
        case 'OK':
            $_SESSION['login'] = $_POST['login'];
            header('Location: index.php');
            break;
            
        case 'User not found':
            $_SESSION['error'] = "Пользователь не найден";
            header('Location: login-form.php');
            exit(); 

        case 'Password incorrect':
            $_SESSION['error'] = "Неверный пароль";
            header('Location: login-form.php');
            exit(); 
    }

    TulaTur::Disconnect();
}
?>