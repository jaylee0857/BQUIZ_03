<?php
include_once "db.php";

// dd($_POST);
$db=${ucfirst($_GET['table'])};
$row1 = $db->find($_POST['ids'][0]);
$row2 = $db->find($_POST['ids'][1]);
dd($row1);
dd($row2);


$tmp = $row1;
$row1['rank'] = $row2['rank'];
$row2['rank'] = $tmp['rank'];


$db->save($row1);
$db->save($row2);



// to("../back.php?do=poster")
?>