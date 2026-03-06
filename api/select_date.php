<?php
include_once "db.php";
    // date(格式, 時間戳)
    // strtotime(時間字串)
    $movie_id = $_POST['movie_id'];
    $row = $Movie->find($movie_id);
    $movie_start = $row['date'];

    $today = date("Y-m-d"); // 今天日期
    for ($i = 0; $i < 3; $i++) {
    $show_date = date("Y-m-d", strtotime($movie_start . " +$i day"));

    // Y-m-d 格是可以比大小
    if ($show_date >= $today) {
        echo "<option value='$show_date'>$show_date</option>";
    }
}


?>