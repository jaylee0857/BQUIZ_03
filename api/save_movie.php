<?php
    include_once "db.php";

//     dd($_POST);
//     Array
// (
//     [name] => 院線片1
//     [level] => 普遍級
//     [lone_time] => 100
//     [year] => 2026
//     [month] => 3
//     [day] => 23
//     [f] => 院線片1f
//     [d] => 院線片1d
//     [mv] => 03B01v.mp4
//     [img] => 03B01.png
//     [intro] => 院線片1院線片1院線片1院線片1院線片1
// )

    $_POST['date'] = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
    unset($_POST['year']);
    unset($_POST['month']);
    unset($_POST['day']);
    
    $Movie->save($_POST);
to("../back.php?do=movie");

?>
