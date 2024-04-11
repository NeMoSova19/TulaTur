<?php
include("tulatur.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    TulaTur::Connect();

    $username = $_SESSION['login'];
    $id = $_GET['id'];

    $result = TulaTur::UserDislikePlace($username, $id);
    if($result == false){
        TulaTur::UserClearPlaceRating($user, $id);
    }
    
    TulaTur::Disconnect();

    header('Location: '.GetPrevPageOr('index.php'));
    exit();
}
?>