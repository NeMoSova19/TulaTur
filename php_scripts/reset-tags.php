<?php
    session_start();

    unset($_SESSION['tags']);
    header('Location: ../index.php');
?>