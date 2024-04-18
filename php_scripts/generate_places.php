<?php
include("../tulatur.php");
session_start();

    $tags = empty($_POST['tags'])?null:explode(',', $_POST['tags']);
    // $tags2 = (isset($_SESSION['tags']) and !empty($_SESSION['tags'])) ? $_SESSION['tags'] : null;
    $daynight = $_POST['daynight'];
    $search = empty($_POST['search'])?null:$_POST['search'];

    
    TulaTur::Connect();
    $places = TulaTur::GetAllPlaces();
    $allTags = TulaTur::GetAllTags();
    TulaTur::Disconnect();
    
    $result = '';
    foreach($places as $row):
        $text = $row['Name'] . ' ' . $row['ShortDescription'] . ' ' . $row['Description'];
        if(($tags and getIntersect($row['Tags'], $tags) or !$tags) ):
            if(!$search or $search and TwoStrings($search, $text)):
                $dayornight = IsDayOrNight($row['Schedule']);
                if($dayornight == 3 or $dayornight == 1 - $daynight):
                    $p_loc = (string)$row['Location'];
                    $p_id = (string)$row['ID'];
                    $p_name = (string)$row['Name'];
                    $p_sdesc = (string)$row['ShortDescription'];
                    $result .=
                        "
                        <div class='place'>
                            <div class='text'>
                                <li class='names_of_items'>
                                    <a class='names_of_items' href='/blank.php?id=$p_id'>$p_name</a>
                                </li>
                                <li class='description_of_items'>$p_sdesc</li>
                            </div>
                            <div class='build-route'>
                                <a href='/blank.php?id=$p_id' class='text-field_input' id='button' value=$p_loc>
                                    Построить маршрут
                                </a>
                            </div>
                        </div>
                        ";
                endif; 
            endif; 
        endif; 
    endforeach;
    unset($_SESSION['tags']);

    // Устанавливаем заголовок ответа в формате html
    header('Content-Type: text/html; charset=utf-8');

    if(!$result){
        if($daynight == 1){
            echo "<h1 style='margin-left: auto;margin-right: auto;display: table; font-size: calc(1.325rem + .9vw); color:#ffffff';>Ничего не найдено</h1>";
        }
        else{
            echo "<h1 style='margin-left: auto;margin-right: auto;display: table; font-size: calc(1.325rem + .9vw);'>Ничего не найдено</h1>";
        }
    }
    else{
        echo $result;
    }
?>