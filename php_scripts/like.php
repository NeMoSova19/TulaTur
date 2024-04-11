<?php
include("../tulatur.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $user = $_SESSION['login'];
    $id = $_GET['id'];
    
    TulaTur::Connect();
    
    $result = TulaTur::UserLikePlace($user, $id);
    if($result == false){
        TulaTur::UserClearPlaceRating($user, $id);
    }
    
    TulaTur::Disconnect();

    header('Location: ../'.GetPrevPageOr('index.php'));
    exit();
}
?>