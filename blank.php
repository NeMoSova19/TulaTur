<?php
    session_start();
    if(isset($_GET['id']) and !empty($_GET['id']) and $_GET['id'] > 0) {
        $id = $_GET['id'];
        
        include("tulatur.php");
        TulaTur::Connect();
        $user = isset($_SESSION['login'])?TulaTur::GetUser($_SESSION["login"]):null;
        $place = TulaTur::GetPlace($id);
        $allTags = TulaTur::GetAllTags();
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
    <title><?=$place["Name"]?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/header.css" type="text/css">
    <link rel="stylesheet" href="css/blank.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script><link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&display=swap" rel="stylesheet">
    <script src="https://api-maps.yandex.ru/2.1/?apikey=f697c4a8-f8c8-478d-a897-005e1cc67a13&load=package.standard&lang=ru-RU" type="text/javascript"></script>
    <script src="js/header.js"></script>
    <script src="js/map.js"></script>
</head>
<body>
    <?php include "header.php"; ?>

    <main>
        <section class="section_main">
            <div class="main_title-block">
                <img class="main_background-img" src="img/tula_day.jpg" alt="">
            </div>
        </section>
        <section class="section_background"></section>
        <section class="main_app_background">
            <section class="place_info">
                <h1 class="title"><?=$place['Name']?></h1>

                <div class="discription">
                    <p class="shortDiscription"><?=$place['ShortDescription']?></p>
                    <p><?=$place['Description']?></p>
                </div>

                <div class="info"> 
                    <div class="tags">
                        <?php 
                        $arr = json_decode($place["Tags"]);
                        $arr_size = count($arr);
                        $cnt = 1;
                        foreach($arr as $tag): 
                        ?>
                            <div class="tag">
                                <?= $allTags[$tag]["Name"]; ?>
                                <?= ($cnt < $arr_size)?'':' ' ?>
                            </div>
                                <?php $cnt++; ?>
                        <?php endforeach; ?>
                    </div>

                    <div class="shedule">

                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    График
                                </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        
                                        <?php 
                                            $shedule = json_decode($place['Schedule']);
                                            $num_day = 1;
                                            foreach($shedule as $day):
                                                $day_str = Int2Week($num_day);
                                                $num_day++;    
                                        ?>
                                        <?=
                                            $day_str;
                                        ?>
                                        :
                                        <?php if($day[0] == $day[1]): ?>
                                            круглосуточно
                                            
                                        <?php else: ?>
                                            <?=
                                                GetTime($day[0])
                                            ?>
                                            -
                                            <?=
                                                GetTime($day[1])
                                            ?>
                                        <?php endif;?>
                                        <br>
                                        <?php 
                                        endforeach;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="btn-marks">
                    <div class="adress">
                        <p class="adress-map"><?=$place['Location']?></p>
                    </div>
                    <div class="buttons">
                        <button type="button" class="btn btn-mark btn_like" title="Нравится" <?=isset($user)?:'disabled'; ?>>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                            </svg>
                            <div class="counter">
                                <?=$place['Ulike']?>
                            </div>
                        </button>
                        <button type="button" class="btn btn-mark btn_dislike" title="Не нравится" <?=isset($user)?:'disabled'; ?>>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-hand-thumbs-down" viewBox="0 0 16 16">
                                <path d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856 0 .289-.036.586-.113.856-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a9.877 9.877 0 0 1-.443-.05 9.364 9.364 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964l-.261.065zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a8.912 8.912 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581 0-.211-.027-.414-.075-.581-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.224 2.224 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.866.866 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1z"/>
                            </svg>
                            <div class="counter">
                                <?=$place['Udislike']?>
                            </div>
                        </button>                    
                    </div>
                </div>
                

                <div class="btn-action">
                    <button type="button" class="btn btn-outline-danger btn_add_to_visited" title="Добавить в избранное">
                        <!-- <img class="icon_add_to_visited" src="img/icon_suitcase.png" alt="Add to visited"> -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-calendar-heart" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5ZM1 14V4h14v10a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1Zm7-6.507c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z"></path>
                        </svg>
                        Хочу посетить
                    </button>
                    <button type="button" class="btn btn-outline-success btn_add_to_visited" title="Посетил">
                        <!-- <img class="icon_add_to_visited" src="img/icon_suitcase.png" alt="Add to visited"> -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
                            <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                        </svg>
                        Посетил
                    </button>
                    <a class="btn btn_planet_link" title="Перейти на сайт" href=<?=$place['Link']?> target="_blank" class="btn">
                        <!-- <img class="icon_planet_link" src="img/planet_link_black.png" alt="Visit web-site"> -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-globe" viewBox="0 0 16 16">
                            <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z"/>
                        </svg>
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

    <script>
        const buttons = document.querySelectorAll('.btn-mark');

        buttons.forEach(button => {
            button.addEventListener('click', () => {
                buttons.forEach(btn => btn.classList.remove('active', 'text-success', 'text-danger'));
                button.classList.add('active');
                if (button.classList.contains('btn_like')) {
                    button.classList.add('text-success');
                } else if (button.classList.contains('btn_dislike')) {
                    button.classList.add('text-danger');
                }
            });
        });

    </script>
</body>
</html>