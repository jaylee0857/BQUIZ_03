<?php
include_once "db.php";

// dd($_POST);
$poster1 = $Poster->find($_POST['ids'][0]);
$poster2 = $Poster->find($_POST['ids'][1]);
dd($poster1);
dd($poster2);


$tmp = $poster1;
$poster1['rank'] = $poster2['rank'];
$poster2['rank'] = $tmp['rank'];


$Poster->save($poster1);
$Poster->save($poster2);



// to("../back.php?do=poster")
?>