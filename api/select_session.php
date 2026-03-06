<?php
include_once "db.php";
    // date(格式, 時間戳)
    // strtotime(時間字串)
    $movie_id = $_POST['movie_id'];
    $movie_date = $_POST['movie_date'];

    $movie = $Movie->find($movie_id);
    
    $moviv_name = $movie['name'];
    // $movie_start = $row['date'];

// 固定場次開始時間
$times = [
    "14:00~16:00"=>"14:00",
    "16:00~18:00"=>"16:00",
    "18:00~20:00"=>"18:00",
    "20:00~22:00"=>"20:00",
    "22:00~24:00"=>"22:00"
];

$today = date("Y-m-d");
$now = time();

foreach ($times as $fulltime => $time) {
    // 把「日期 + 場次開始時間」組成完整時間字串
    $session_start = strtotime($movie_date . " " . $time);

    $q = $Orders->sum('qt',['name'=>$moviv_name,'date'=>$movie_date, 'session'=>$fulltime]);
    $qq = 20-$q;
    // 如果不是今天，全部都顯示
    if ($movie_date != $today) {
        echo "<option value='$fulltime'>$fulltime</option>";
    } 
    // 如果是今天，只顯示現在之後的場次
    else {
        if ($session_start > $now) {
            echo "<option value='$fulltime'>$fulltime 剩餘座位 $qq</option>";
        }
    }
}


?>