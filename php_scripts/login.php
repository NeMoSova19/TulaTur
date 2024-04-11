<?php
include("../tulatur.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = $_POST['login'];
    $password = $_POST['password'];
    
    TulaTur::Connect();

    $result = TulaTur::VerifyUser($username, $password);
    
    TulaTur::Disconnect();
    
    switch ($result) {
        case 'OK':
            $_SESSION['login'] = $_POST['login'];
            header('Location: ../'.GetPrevPageOr('index.php'));
            exit();
            
        case 'User not found':
            $_SESSION['error'] = "Пользователь не найден";
            header('Location: ../login-form.php');
            exit(); 

        case 'Password incorrect':
            $_SESSION['error'] = "Неверный пароль";
            header('Location: ../login-form.php');
            exit(); 
    }

}
?>