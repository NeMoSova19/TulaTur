<?php

$user_authenticated = isset($_SESSION['login'])?true:false;

?>

<head>
    <link rel="stylesheet" href="/css/header.css" type="text/css">
    <link rel="stylesheet" href="/css/header_adaptive.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap">
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="/js/header.js"></script>
</head>

<body>
    <header class="header">
        <nav class="nav_menu">
            <a href="/php_scripts/reset-tags.php" class="logo_name first">Тула</a>
            <div class="logo_block"><a href="/php_scripts/reset-tags.php" class="logo"><img class="logo_img" src="img/logo.png" alt="Logo"></a></div>
            <a href="/php_scripts/reset-tags.php" class="logo_name second">Тур</a>
            <button class="btn_icon_heart btn-header" <?= $user_authenticated ? '' : 'disabled' ?>>
                <img class="nav-icon_heart" src="img/icon_heart.png" alt=""> 
                <?php if ($user_authenticated): ?>
                    <a class="nav-icon_heart-text" href="/liked.php">Хочу посетить</a>
                <?php else: ?>
                    <span class="nav-icon_suitcase-text">Хочу посетить</span>
                <?php endif; ?>
            </button>
            <button class="btn_icon_suitcase btn-header" <?= $user_authenticated ? '' : 'disabled' ?>>
                <img class="nav-icon_suitcase" src="img/icon_suitcase.png" alt=""> 
                <?php if ($user_authenticated): ?>
                    <a class="nav-icon_suitcase-text" href="/visited.php">Мои поездки</a>
                <?php else: ?>
                    <span class="nav-icon_suitcase-text">Мои поездки</span>
                <?php endif; ?>
            </button>
            
            <button class="auth btn-header" id="loginButton">
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
</body>
