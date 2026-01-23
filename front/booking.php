<style>
    #box{
        width: 540px;
        height: 370px;
        margin:auto;
        padding-top: 20px;
        background-image: url("./icon/03D04.png");
        box-sizing: border-box;
    }

    .seats{
        display: flex;
        flex-wrap: wrap;
        width: 320px;
        height: 340px;
        margin:auto;
    }
    .seat{
        width: calc(320px / 5);
        height: 80px;
        position: relative;
    }

    .check{
        position: absolute;
        bottom: 5px;
        right: 5px;
    }

    .booked{
        background-image:url('../icon/03D03.png');
        background-position:center;
        background-repeat:no-repeat;
    }
    .null{
        background-image:url('../icon/03D02.png');
        background-position:center;
        background-repeat:no-repeat;
    }
</style>

<?php
    include_once "../api/db.php";
    
    $data= $Movie->find($_GET['movie_id']);
    $ss = [
        1 => ["start" => "14:00", "text" => "14:00 ~ 16:00"],
        2 => ["start" => "16:00", "text" => "16:00 ~ 18:00"],
        3 => ["start" => "18:00", "text" => "18:00 ~ 20:00"],
        4 => ["start" => "20:00", "text" => "20:00 ~ 22:00"],
        5 => ["start" => "22:00", "text" => "22:00 ~ 24:00"],
        ];
    $time = $ss[$_GET['session']]['text'];
?>
<!-- 先把座位背景拿出來 -->
<div id="box">
    <div class="seats">
        <?php
            for ($i=0; $i <20 ; $i++) { 
                $f = (floor($i/5)+1);
                $num = ($i % 5)+1;
                echo "<div class='seat null'>{$f}排{$num}號";
                echo "<input type='checkbox' name='' value='' class='check'>";
                echo "</div>";
            }
        ?>
    </div>
</div>
<!-- 320/340 -->
<div class="">
    <p>你選則的電影是: <?=$data['name']?></p>
    <p>你選擇的時刻是:  <?=$_GET['date']?> <?=$time?></p>
    <p>您已經勾選了 <span>10</span>張票, 最多可以購買四張票</p>
    <div class="ct">
        <input id="booking_start" type="button" value="上一步">
        <input id="res_start" type="button" value="訂購">
    </div>
</div>