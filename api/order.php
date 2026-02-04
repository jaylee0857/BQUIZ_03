<?php
include_once "db.php";

// dd($_POST)

// (
    // [seats] => Array
    //     (
    //         [0] => 15
    //         [1] => 16
    //         [2] => 18
    //         [3] => 17
    //     )

//     [movie] => 院線片01
//     [date] => 2026-01-28
//     [session] => 16:00 ~ 18:00
// )
sort($_POST['seats']);
$_POST['qt'] = count($_POST['seats']);
$_POST['no']   = date("Ymd") . sprintf("%04d", ((int)$Orders->max('id')) + 1);
// $_POST['seats'] = implode(',', $_POST['seats']);
$_POST['seats'] = json_encode($_POST['seats']);

// dd($_POST);
$Orders->save($_POST);
?>

<style>
    #res_table{
        width: 500px;
        margin: 0 auto;
        padding:20px;
        border: 1px solid #999;
    }
</style>

<table id="res_table">
    <tr>
        <td>感謝您的訂購,您的訂單編號是<?=$_POST['no']?></td>
        <td></td>
    </tr>
    <tr>
        <td>電影名稱:</td>
        <td><?=$_POST['movie']?></td>
    </tr>
    <tr>
        <td>日期:</td>
        <td><?=$_POST['date']?></td>
    </tr>
    <tr>
        <td>場次時間</td>
        <td><?=$_POST['session']?></td>
    </tr>
    <tr>
        <td>
        <?php
            // $seats = explode(',', $_POST['seats']);
            $seats = json_decode($_POST['seats'],true);

            foreach ($seats as $s) {
            $s = (int)$s;
            echo (floor($s/5) + 1) . "排" . (($s % 5) + 1) . "號<br>";
            }
        ?>
        <div>共<?=$_POST['qt']?>張票</div>
        </td>
    </tr>
    <tr>
        <td>
            <button onclick="location.href='?do=order'">確認</button>
        </td>
    </tr>
</table>