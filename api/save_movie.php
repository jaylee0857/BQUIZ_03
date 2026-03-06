<?php
include_once "db.php";

$_POST['date'] = $_POST['y']."-".$_POST['m']."-".$_POST['d'];
unset( $_POST['y']);
unset( $_POST['m']);
unset( $_POST['d']);

$Movie->save($_POST);
to("../back.php?do=movie");
?>