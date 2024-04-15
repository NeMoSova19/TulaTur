<?php
    session_start();
    include("../tulatur.php");
    $prev_page = GetPrevPageOr('index.php');
    header('Location: ../'.$prev_page);
    exit();
?>