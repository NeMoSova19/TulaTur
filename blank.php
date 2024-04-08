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
            <div class="discription">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis voluptatum autem exercitationem, qui non pariatur.</p>
            </div>
            <div class="adress">
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing.</p>
            </div>
            <div class="like-dislike">
                <img class="icon_like" src="img/free-icon-favorite-2989863.png" alt="Like">
                <img class="icon_dislike" src="#" alt="Dislike">
            </div>
            <div class="comments">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quos qui officia doloribus doloremque sunt et enim dignissimos, quam ipsum non!</p>
            </div>
            <div class="add_to_visited">
                <img  class="icon_add_to_visited" src="img/icon_suitcase.png" alt="Add to visited">
            </div>
        </section>
</body>
</html>