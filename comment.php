<?php
include("tulatur.php");
session_start();

    TulaTur::Connect();

    $id = $_GET['id'];
    $comment = $_POST['comment'];

    TulaTur::UserWriteComment($_SESSION['login'], $id, $comment);

    TulaTur::Disconnect();
?>