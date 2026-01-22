<?php
include_once "db.php";

$Movie->del($_GET['id']);

to("../back.php?do=movie")
?>