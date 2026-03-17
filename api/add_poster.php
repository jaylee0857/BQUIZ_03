<?php
    include_once "db.php";


    $Poster->save($_POST);
to("../back.php?do=poster");

?>