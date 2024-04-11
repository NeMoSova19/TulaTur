<?php
include("tulatur.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    TulaTur::Connect();

    $username = $_POST['login'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    
    if($password1 === $password2){
        $result = TulaTur::TryRegisterNewUser($username, $password1);
        switch ($result) {
            case 'OK':
                $_SESSION['login'] = $_POST['login'];
                header('Location: '.GetPrevPageOr('index.php'));
                break;
                
            case 'User already exists':
                $_SESSION['error'] = "Пользователь уже существует";
                header('Location: registration-form.php');
                exit(); 

            case 'Invalid password':
                $_SESSION['error'] = "Пароль должен быть не менее 8 символов
                <br>Пароль должен содержать не менее 1 прописной буквы
                <br>Пароль должен содержать не менее 1 цифры";
                header('Location: registration-form.php');
                exit(); 
        }
    }
    else{
        $_SESSION['error'] = "Пароли не совпадают";
        header('Location: registration-form.php');
        exit(); 
    }

    TulaTur::Disconnect();
}
?>