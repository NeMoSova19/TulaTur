<?php 
    session_start();

    if(isset($_SESSION['login'])){
        echo 'out';
        return;
    }
    echo 'log';
    return;
?>