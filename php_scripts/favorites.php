<?php
include("../tulatur.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $user = $_SESSION['login'];
    $id = $_POST['id'];
    
    TulaTur::Connect();
    
    $result = TulaTur::AddFavorite($user, $id);
    if($result === true){
        TulaTur::RemoveFavorite($user, $id);
    }
    TulaTur::Disconnect();

    $out = array(
        'result' => !$result
    );

    // Устанавливаем заголовок ответа в формате json
    header('Content-Type: text/json; charset=utf-8');    
    
    // Кодируем данные в формат json и отправляем
    echo json_encode($out);
}
?>