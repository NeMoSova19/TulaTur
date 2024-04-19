<?php
    session_start();
    include('tulatur.php');

    if(!isset($_SESSION['login'])){
        header('Location: ../'.GetPrevPageOr('index.php'));
        exit();
    }

    $_SESSION['prev_page'] = "liked.php";

    TulaTur::Connect();
    $fav = TulaTur::GetUserFavorites($_SESSION['login']);
    $all_fav = [];
    foreach($fav as $f){
        array_push($all_fav,TulaTur::GetPlace($f));
    }
    TulaTur::Disconnect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/liked_and_visited.css">
    <link rel="stylesheet" href="css/liked_and_visited_adaptive.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script><link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&display=swap" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

</head>
<?php include "header.php"; ?>
<body>
    <main>
        <section class="section_main">
            <div class="main_title-block">
                <img class="main_background-img" src="img/tula_day.jpg" alt="">
                <img class="main_background-img img-night" src="img/tula_night.jpg" alt="" style="display: none;">
            </div>
            <div class="title"><h1 class="main_title">Избранное</h1></div>
        </section>
        <section class="section_background"></section>
        <section class="main_app_background">

        <?php foreach($all_fav as $f): $p_id = (string)$f['ID'];?>
            <div class="card">
                <div class="card-body">
                    <a class="card-title" href='/blank.php?id=<?=$p_id?>'><span><?=$f['Name']?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#dc3545" class="bi bi-calendar-heart" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5ZM1 14V4h14v10a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1Zm7-6.507c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z"/>
                        </svg>
                    </a>
                    <p class="card-text"><?=$f['ShortDescription']?></p>
                </div>
            </div>
        <?php endforeach; ?>  
                        
        </section>
    </main>
</body>
</html>