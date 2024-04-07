<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/adaptive.css" type="text/css">
    <link rel="stylesheet" href="css/adaptive_main.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="js/script.js"></script>
    <script src="https://api-maps.yandex.ru/v3/?apikey=aaa5550c-e388-41b3-9114-2471118f4cdd&lang=ru_RU"></script>

    <title>Document</title>
</head>
<body>
    <header class="header">
        <nav class="nav_menu">
            <a href="#" class="logo_name first">Тула</a>
            <div class="logo_block"><a href="#" class="logo"><img class="logo_img" src="img/logo.png" alt="Logo"></a></div>
            <a href="#" class="logo_name second">Тур</a>
            <button class="btn_icon_heart"><img class="nav-icon_heart" src="img/icon_heart.png" alt=""> <span class="nav-icon_heart-text">Избранное</span></button>
            <button class="btn_icon_suitcase"><img class="nav-icon_suitcase" src="img/icon_suitcase.png" alt=""> <span class="nav-icon_suitcase-text">Мои поездки</span></button>
            
            <button class="auth" id="loginButton">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right auth_logo" viewBox="0 0 16 16"> 
                <?php if(isset($_SESSION['login'])): ?>
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/> 
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/> 
                <?php else: ?>
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/> 
                <?php endif; ?>
            </svg>
                <span class="auth_text">
                    <?= isset($_SESSION['login'])?($_SESSION['login']):"Войти" ?>
                </span>
            </button>
        </nav>
    </header>
    <main>
        <section class="section_main">
            <div class="main_title-block">
                <div class="title-tour"><h1 class="main_title">Начни свой тур</h1></div>
                <img class="main_background-img img-day" src="img/tula_day.jpg" alt="">
                <img class="main_background-img img-night" src="img/tula_night.jpg" alt="" style="display: none;">
            </div>
        </section>
        <section class="section_background"></section>
        <section class="main_app_background">
            <div class="switcher">
                <button class="day-type"><h2 class="day_tour_text day-under">Дневной тур</h2></button>
                <img class="switcher_logo" src="img/free-icon-day-and-night-8495814.png" alt="переключатель" a="#">
                <button class="night-type"><h2 class="day_tour_text night_under">Ночной тур</h2></button>
            </div>
           
            <?php 
            include("tulatur.php");
            TulaTur::Connect();
            $result = TulaTur::GetAllPlaces();
            TulaTur::Disconnect();
            ?>

            <div class="places">
                <div class="place">
                    <div class="text">
                        <li class="names_of_items">Имя</li>
                        <li class="description_of_items">Описание</li>
                    </div>
                    <button type="submit" class="text-field_input" id="button">
                        Построить маршрут
                    </button>

                </div>
            </div>

            <div class="list">
                <ul class="list_of_items">
                    
                    <?php foreach ($result as $row): ?>
                    
                        <li class="names_of_items"><?= $row["Name"]; ?></li>
                        <li class="description_of_items"><?= $row["Description"]; ?></li>
                            
                    <?php endforeach; ?>
                    
                </ul>
                <div class="list_of_buttons">

                    <?php foreach ($result as $row): ?>
                        
                        <li>
                            <button type="submit" class="text-field_input" id="button" value=<?= $row["Name"]; ?>>
                                Построить маршрут
                            </button>
                        </li>
                            
                    <?php endforeach; ?>

                </div>
            </div>
            <div id="map" class="map">
                <h2 class="meme">Тут должна быть карта =)))</h2>
            </div>
        </section>
    </main>
</body>
</html>