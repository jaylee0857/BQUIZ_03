<?php
include_once "db.php";

$Orders->del([$_POST['type'] => $_POST['value']]);

// to("../back.php?do=movie")
?>