<?php
include("tulatur.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    TulaTur::Connect();

    $username = $_POST['login'];
    $password = $_POST['password'];

    $result = TulaTur::VerifyUser($username, $password);
    if($result === "OK"){
        $_SESSION['login'] = $_POST['login'];
        header('Location: index.php');
    }
    else{
        if($result === "User not found"){
            $_SESSION['error'] = "Пользователь не найден";
            header('Location: login-form.php');
            exit(); 
        }
        $_SESSION['error'] = "$result";
        header('Location: login-form.php');
        exit(); 
    }

    TulaTur::Disconnect();
}
?>