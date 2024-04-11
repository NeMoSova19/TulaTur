<?php
session_start();

    if (isset($_GET['tags'])) {
        $_SESSION['tags'] = explode(',',$_GET['tags']);
        echo $_GET['tags'];
    }
    else{
        unset($_SESSION['tags']);
        
    }

    unset($_SESSION['search-input']);

    header('Location: ../index.php');
?>