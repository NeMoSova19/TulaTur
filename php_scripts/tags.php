<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['search-input'])){
        $_SESSION['search-input'] = $_POST['search-input'];
    }
    else{
        unset($_SESSION['search-input']);
    }

    if (isset($_POST['tags'])) {
        $_SESSION['tags'] = $_POST['tags'];
    }
    else{
        unset($_SESSION['tags']);
    }

    header('Location: ../index.php');
}
?>