<?php
include_once "db.php";

// dd($_POST)

$Poster->save($_POST);
to("../back.php?do=poster")
?>