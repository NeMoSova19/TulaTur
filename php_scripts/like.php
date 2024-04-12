<?php
include("../tulatur.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $user = $_SESSION['login'];
    $id = $_POST['id'];
    
    TulaTur::Connect();
    
    $result = TulaTur::UserLikePlace($user, $id);
    if($result == false){
        TulaTur::UserClearPlaceRating($user, $id);
    }
    $place = TulaTur::GetPlace($id);
    TulaTur::Disconnect();

    $out = array(
        'active' => $result,
        'like' => $place['Ulike'],
        'dislike' => $place['Udislike'],
    );

    // Устанавливаем заголовок ответа в формате json
    header('Content-Type: text/json; charset=utf-8');
    
    // Кодируем данные в формат json и отправляем
    echo json_encode($out);
}
?>