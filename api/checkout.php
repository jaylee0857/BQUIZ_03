<?php
    include_once "db.php";

    $_POST['no'] = date("Ymd")."00".($Orders->max('id')+1);
    $_POST['seat'] = json_encode($_POST['seat']);
    $_SESSION['order'] = $_POST;

    $Orders->save($_POST);
?>