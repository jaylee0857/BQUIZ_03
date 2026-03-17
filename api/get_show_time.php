<?php
    include_once "db.php";

    $movie_id = $_POST['movie_id'];
    $name = $Orders->find($movie_id)['name'];
    $movie_date = $_POST['movie_date'];


    if ($movie_date == "2026-03-17") {
        $t =[
            "16:00~18:00",
            "18:00~20:00",
            "20:00~22:00",
            "22:00~24:00"
        ];
    }else{
        $t =[
            "14:00~16:00",
            "16:00~18:00",
            "18:00~20:00",
            "20:00~22:00",
            "22:00~24:00"
        ];
    }


    foreach ($t as $key => $value) {
        $qt = $Orders->sum('qt',['name'=>$name,'date'=>$movie_date,'show_time'=>$value]);
        $a = 20 - $qt;
        echo "<option value='$value'>$value 剩餘座位($a)</option>";
    }

?>

