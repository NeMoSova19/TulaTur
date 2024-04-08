<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tags'])) {
        $tags = $_POST['tags'];
        $_SESSION['tags'] = $tags;
    }
    else{
        unset($_SESSION['tags']);
    }
    header('Location: index.php');
}
?>