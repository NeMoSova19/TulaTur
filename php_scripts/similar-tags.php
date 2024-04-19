<?php
session_start();

    if (isset($_GET['tags'])) {
        $_SESSION['tags'] = explode(',',$_GET['tags']);
    }
    else{
        unset($_SESSION['tags']);
    }

    header('Location: ../index.php');
    exit();
?>