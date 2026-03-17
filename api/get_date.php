<?php
    include_once "db.php";

    $movie_id = $_POST['movie_id'];

    $data = $Movie->find($movie_id);
    $onday = $data['date'];
    $today = date("Y-m-d");
    for ($i=0; $i < 3; $i++) { 
        $play_day = date("Y-m-d", strtotime("$onday +$i day"));

        if ($play_day >= $today) {
            echo "<option value='$play_day'>$play_day</option>";
        }
    }

?>
