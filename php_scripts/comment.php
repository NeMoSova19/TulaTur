<?php
include("../tulatur.php");
session_start();

    $id = $_GET['id'];
    $comment = $_POST['comment'];

    if(empty($comment)) {
        header('Location: ../blank.php?id='.$id);
        exit();
    }

    TulaTur::Connect();
    TulaTur::WriteComment($_SESSION['login'], $id, $comment);
    TulaTur::UserWriteComment($_SESSION['login'], $id, $comment);
    TulaTur::Disconnect();
    
    header('Location: ../blank.php?id='.$id);
    exit();
?>