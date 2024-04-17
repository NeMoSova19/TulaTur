<?php
include("../tulatur.php");
session_start();

    $id = $_POST['id'];
    $comment = $_POST['comment'];

    $error;

    if(!empty($comment)) {        
        TulaTur::Connect();
        TulaTur::WriteComment($_SESSION['login'], $id, $comment);
        TulaTur::Disconnect();
        $error = 'OK';
    }
    else{
        $error = 'NOK';
    }
    
    $out = array(
        'error' => $error,
    );
    
    // Устанавливаем заголовок ответа в формате json
    header('Content-Type: text/json; charset=utf-8');
    
    // Кодируем данные в формат json и отправляем
    echo json_encode($out);
?>