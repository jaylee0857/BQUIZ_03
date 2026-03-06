<?php
include_once "db.php";

$db=${$_GET['table']};

$row1 = $Poster->find($_POST['id']);
$row2 = $Poster->find($_POST['sw']);
$tmp = $row1;
$row1['rank'] = $row2['rank'];
$row2['rank'] = $tmp['rank'];

$db->save($row1);
$db->save($row2);



?>