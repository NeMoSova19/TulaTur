<?php
    session_start();
    $_SESSION['prev_page'] = "index.php";

    include("tulatur.php");
    TulaTur::Connect();
    $result = TulaTur::GetAllPlaces();
    $allTags = TulaTur::GetAllTags();
    TulaTur::Disconnect();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тула Тур</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css" type="text/css">
    <link rel="stylesheet" href="/css/adaptive.css" type="text/css">
    <link rel="stylesheet" href="/css/adaptive_main.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script><link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&display=swap" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="/js/script.js"></script>
    <script src="https://api-maps.yandex.ru/v3/?apikey=aaa5550c-e388-41b3-9114-2471118f4cdd&lang=ru_RU"></script>

</head>
<body>
    <?php include "header.php"; ?>

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
            <form id="form-search">
                <div class="search-container">
                    <div class="search-section">
                        <input  type="text"   class="search-input" name="search-input" placeholder="Введите запрос..." value='<?= isset($_SESSION['search-input'])?$_SESSION['search-input']:''; ?>' onkeypress="return event.keyCode != 13;">
                        <!-- <button type="button" class="search-button">            <p>Поиск<p>     </button> -->
                        <button type="button" class="reset-tags search-button"> <p>Сбросить</p> </button>
                    </div>
                </div>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Теги
                        </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <?php foreach($allTags as $tag): ?>
                            <div>
                                <input type="checkbox" id=<?= $tag['Name']; ?> name="tags[]" value=<?= $tag['ID']; ?> <?= isset($_SESSION['tags'])?(in_array($tag['ID'], $_SESSION['tags'])?'checked':''):'' ?> >
                                <label for=<?= $tag['Name']; ?>><?= $tag['Name']; ?></label><br>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        </div>
                    </div>
                </div>
            </form>
            
            <div class="switcher">
                <button class="day-type"><h2 class="day_tour_text day-under">Дневной тур</h2></button>
                <img class="switcher_logo switcher_logo-day" src="img/free-icon-day-and-night-8495814.png" alt="переключатель">
                <img class="switcher_logo switcher_logo-night" src="img/night.png" alt="переключатель" style="display:none;">
                <button class="night-type"><h2 class="day_tour_text night_under">Ночной тур</h2></button>
            </div>

           
            <div class="places" id="places">
                <h4 style='margin-left: auto; margin-right: auto; display: table;'>Ничего не найдено</h4>
                
            </div>

        </section>
    </main>

</body>
</html>