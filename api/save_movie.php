<?php
include_once "db.php";

if (!empty($_FILES['pre']['tmp_name'])) {
    move_uploaded_file($_FILES['pre']['tmp_name'], "../upload/{$_FILES['pre']['name']}");
    $_POST['pre'] = $_FILES['pre']['name'];
}
if (!empty($_FILES['poster']['tmp_name'])) {
    move_uploaded_file($_FILES['poster']['tmp_name'], "../upload/{$_FILES['poster']['name']}");
    $_POST['poster'] = $_FILES['poster']['name'];
}

$_POST['date'] = "{$_POST['y']}-{$_POST['m']}-{$_POST['d']}";
unset($_POST['y']);
unset($_POST['m']);
unset($_POST['d']);
if(!isset($_POST['id'])){
    // 新增 
    $_POST['sh'] = 1;
    $_POST['rank'] = $Movie->max('rank')+1;
}


dd($_POST);
    $Movie->save($_POST);
    to("../back.php?do=movie");
?>