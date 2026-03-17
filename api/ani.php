<?php
    include_once "db.php";


    $_SESSION['ani'] = $_POST['ani'];

to("../back.php?do=poster");

?>