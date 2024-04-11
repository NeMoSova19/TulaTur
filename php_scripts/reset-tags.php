<?php
    session_start();

    unset($_SESSION['tags']);
    unset($_SESSION['search-input']);
    header('Location: ../index.php');
?>