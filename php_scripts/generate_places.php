<?php
include("../tulatur.php");
session_start();

    $tags = empty($_POST['tags'])?null:explode(',', $_POST['tags']);
    $daynight = $_POST['daynight'];
    $search = empty($_POST['search'])?null:$_POST['search'];

    
    TulaTur::Connect();
    $places = TulaTur::GetAllPlaces();
    $allTags = TulaTur::GetAllTags();
    TulaTur::Disconnect();
    
    $result = '';
    foreach($places as $row):
        if($tags and getIntersect($row['Tags'], $tags) or !$tags):
            if(!$search or $search and ( TwoStrings($search, $row['Name']) or TwoStrings($search, $row['ShortDescription']) or TwoStrings($search, $row['Description']))):
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
    

    // Устанавливаем заголовок ответа в формате html
    header('Content-Type: text/html; charset=utf-8');

    if(!$result){
        echo "<h1 style='
        margin-left: auto;
        margin-right: auto;
        display: table;
    '>Ничего не найдено</h1>";
    }
    else{
        echo $result;
    }
?>