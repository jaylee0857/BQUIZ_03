<?php
include_once "db.php";

$movie = $Movie->find($_GET['movie_id']);           // 依 GET 的 movie_id 去資料庫找出該電影資料（包含上映日 date）

$start = strtotime($movie['date']);                 // 把上映日轉成時間戳（上映日 00:00:00）
$today = strtotime(date("Y-m-d"));                  // 把今天日期轉成時間戳（今天 00:00:00）

$gap = floor(($today - $start) / 86400);            // 計算「今天 - 上映日」相差幾天
                                                   // 86400 = 60*60*24（一天的秒數）
                                                   // gap 可能是負數：代表還沒上映（今天在上映日前）

// 這個迴圈用來產生「上映日起算的三天」(0,1,2) 的日期選項
// 但你用 $i = $gap 開始：代表如果今天已經是上映後第1天，就從第1天開始列（不列過去的那天）
for ($i = $gap; $i < 3; $i++) {                     // $i 會跑 gap, gap+1, gap+2（最多列到第2天）
    $d = date("Y-m-d", strtotime("+$i days", $start));     // option 的 value：YYYY-mm-dd（例如 2026-01-23）
    $str = date("m月d日l", strtotime("+$i days", $start)); // option 顯示文字：月日星期（例如 01月23日Friday）
                                                           // 注意：l 會是英文星期（Friday）
                                                           // 如果要中文星期，通常要另外處理或用 setlocale
    echo "<option value='{$d}'>{$str}</option>";     // 輸出下拉選單 option
}




?>