<?php
    session_start();
    if(isset($_GET['id']) and !empty($_GET['id']) and $_GET['id'] > 0) {
        $id = $_GET['id'];
        
        include("tulatur.php");
        TulaTur::Connect();
        $place = TulaTur::GetPlace($id);
        TulaTur::Disconnect();
        if(!isset($place) or empty($place)){
            ?>
            <p>
                Место не найдено.
            </p>
            <p>
                Invalid id
            </p>
        <?php
        // сюда какую-нибудь балванку покрасивее надо
        exit();
        }

    } else {
        ?>
            <p>
                Место не найдено.
            </p>
            <p>
                Invalid id
            </p>
        <?php
        // сюда какую-нибудь балванку покрасивее надо
        exit(); 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/header.css" type="text/css">
    <link rel="stylesheet" href="css/blank.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&display=swap" rel="stylesheet">
    <script src="https://api-maps.yandex.ru/2.1/?apikey=f697c4a8-f8c8-478d-a897-005e1cc67a13&load=package.standard&lang=ru-RU" type="text/javascript"></script>
    <script src="js/header.js"></script>
    <script src="js/map.js"></script>
</head>
<body>
    <?php include "header.php"; ?>

    <main>
        <section class="section_main">
            <div class="main_title-block">
                <h1 class="main_title"><?=$place['Name']?></h1>
                <img class="main_background-img" src="img/tula_day.jpg" alt="">
            </div>
        </section>
        <section class="section_background"></section>
        <section class="main_app_background">
            <section class="place_info">
                <div class="discription">
                    <p><?=$place['Description']?></p>
                </div>
                <div class="adress">
                    <p class="adress-map"><?=$place['Location']?></p>
                </div>
                <div class="buttons">
                    <button class="btn btn_like" title="Нравится"><img class="icon_like" src="img/like_black.png" alt="Like"></button>
                    <button class="btn btn_dislike" title="Не нравится"><img class="icon_dislike" src="img/dislike_black.png" alt="Dislike"></button>
                    <button class="btn btn_add_to_visited" title="Добавить в избранное"><img class="icon_add_to_visited" src="img/icon_suitcase.png" alt="Add to visited"></button>
                    <a class="btn btn_planet_link" title="Перейти на сайт" href=<?=$place['Link']?> target="_blank" class="btn">
                        <img class="icon_planet_link" src="img/planet_link_black.png" alt="Visit web-site">
                    </a>
                </div>

                <div class="map">
                    <div id="map" style="width: 100%; height: 100%;"></div>
                </div>
                <div class="comments">
                    <?=$place['Comments']?>
                </div>
            </section>
        </section>
</body>
</html>