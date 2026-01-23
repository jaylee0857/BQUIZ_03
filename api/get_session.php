<?php
include_once "db.php";


$movie_id = $_GET['movie_id'];          // 電影ID（這裡暫時沒用到，但先留著）
$selDate  = $_GET['date'];         // 使用者選的日期（沒選就用今天）

$today = date("Y-m-d");                              // 今天日期字串，例如 2026-01-23
$nowTs = time();                                     // 現在時間戳

// 5 個場次：key 是場次代號，value 是「開始時間」+「顯示文字」
$ss = [
  1 => ["start" => "14:00", "text" => "14:00 ~ 16:00"],
  2 => ["start" => "16:00", "text" => "16:00 ~ 18:00"],
  3 => ["start" => "18:00", "text" => "18:00 ~ 20:00"],
  4 => ["start" => "20:00", "text" => "20:00 ~ 22:00"],
  5 => ["start" => "22:00", "text" => "22:00 ~ 24:00"],
];

foreach ($ss as $i => $s) {                          // 逐一處理每個場次
  if ($selDate === $today) {                         // 如果選的是今天才需要判斷「過了沒」
    $startTs = strtotime($today . " " . $s["start"]); // 把「日期+開始時間」轉成時間戳
    if ($nowTs >= $startTs) continue;                // 如果現在 >= 開始時間 → 這場已開始，不顯示
  }

  echo "<option value='{$i}'>{$s['text']}</option>"; // 印出下拉選單選項
}
?>