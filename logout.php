<?php
session_start();
include("tulatur.php");
$prev_page = GetPrevPageOr('index.php');
session_unset();
session_destroy();
header('Location: '.$prev_page);
exit();
?>