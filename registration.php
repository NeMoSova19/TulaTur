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
        if($result === "OK"){
            $_SESSION['login'] = $_POST['login'];
            header('Location: index.php');
        }
        else{
            echo "$result";
        }
    }
    else{
        echo "Пароли не совпадают";
    }

    TulaTur::Disconnect();
}
?>