<?php
include("tulatur.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    TulaTur::Connect();

    $username = $_POST['login'];
    $password = $_POST['password'];

    $result = TulaTur::VerifyUser($username, $password);
    if($result === "OK"){
        $_SESSION['user_id'] = $_POST['login'];

        header('Location: index.php');
    }
    else{
        echo "$result";
    }

    TulaTur::Disconnect();
}
?>