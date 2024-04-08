<?php
    session_start();
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
    <script src="js/header.js"></script>
</head>
<body>
    <?php include "header.php"; ?>

    <?php
        if(isset($_GET['id']) and !empty($_GET['id']) and $_GET['id'] > 0) {
            $product_id = $_GET['id'];
                ?>
                <p>
                    Вы просматриваете товар с id <?= $product_id; ?>
                </p>
                <?php
        } else {
            ?>
            <p>
                Товар не найден
            </p>
            <?php
        }
    ?>

    <main>
        <section class="section_main">
            <div class="main_title-block">
                <h1 class="main_title">Lorem, ipsum.</h1>
                <img class="main_background-img" src="img/tula_day.jpg" alt="">
            </div>
        </section>
        <section class="section_background"></section>
        <section class="main_app_background">
            <section class="place_info">
                <div class="discription">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis voluptatum autem exercitationem, qui non pariatur.</p>
                </div>
                <div class="adress">
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing.</p>
                </div>
                <div class="buttons">
                    <button class="btn btn_like" title="Нравится"><img class="icon_like" src="img/like_black.png" alt="Like"></button>
                    <button class="btn btn_dislike" title="Не нравится"><img class="icon_dislike" src="img/dislike_black.png" alt="Dislike"></button>
                    <button class="btn btn_add_to_visited" title="Добавить в избранное"><img class="icon_add_to_visited" src="img/icon_suitcase.png" alt="Add to visited"></button>
                    <button class="btn btn_planet_link" title="Перейти на сайт"><img class="icon_planet_link" src="img/planet_link_black.png" alt="Visit web-site"></button>
                </div>
                <div class="map">
                    <p>а я карта я карта</p>
                    <p>я рюкзак я рюкзак</p>
                </div>
                <div class="comments">
                    <p>Комменты:</p>
                    <p>Политический срач в комментах</p>
                    <p>Политический срач в комментах</p>
                    <p>Политический срач в комментах</p>
                    <p>Политический срач в комментах</p>
                    <p>Политический срач в комментах</p>
                    <p>Политический срач в комментах</p>
                    <p>Политический срач в комментах</p>
                    <p>Политический срач в комментах</p>
                </div>
            </section>
        </section>
</body>
</html>