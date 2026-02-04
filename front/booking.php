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

    .check_seat{
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
    // $time = $_GET['session'];

    $rows = $Orders->all(['movie'=>$data['name'],'date'=> $_GET['date'], 'session'=>$_GET['session']]);
    $allSeats = [];

    foreach ($rows as $row) {
        $allSeats = array_merge($allSeats, json_decode($row['seats'],true));
    }
    // dd($sql);
?>
<!-- 先把座位背景拿出來 -->
<div id="box">
    <div class="seats">
        <?php
            for ($i=0; $i <20 ; $i++) { 
                $f = (floor($i/5)+1);
                $num = ($i % 5)+1;
                $is_book = in_array($i,$allSeats) ? 'booked':'null';
                echo "<div class='seat $is_book'>{$f}排{$num}號";
                if (!in_array($i,$allSeats)) {
                    echo "<input type='checkbox' name='' value='$i' class='check_seat'>";
                }
                echo "</div>";
            }
        ?>
    </div>
</div>
<!-- 320/340 -->
<div class="">
    <p>你選則的電影是: <?=$data['name']?></p>
    <p>你選擇的時刻是:  <?=$_GET['date']?> <?=$time?></p>
    <p>您已經勾選了 <span id="tickets">0</span>張票, 最多可以購買四張票</p>
    <div class="ct">
        <input id="booking_start" type="button" value="上一步">
        <input id="res_start" type="button" value="訂購">
    </div>
</div>

<script>

    let seats = [];
    //這段要多看幾次
    $(".check_seat").click(function(){
        let seat =$(this).val();
        console.log(seats.length == 4);
        if ($(this).prop('checked')) {
            // +入陣列

            if (seats.length < 4) {
                seats.push(seat)
            }else {
                alert("最多可以購買四張票")
                $(this).prop('checked',false)
            }
        }else {
            // 移出陣列
            seats.splice(seats.indexOf(seat),1)
        }
        $("#tickets").text(seats.length)
        console.log(seats);

    })

    // $("#booking_start").click(function(){

    // })
    $('#res_start').click(function(){
        let movie = "<?=($data['name'])?>";
        let date = "<?=($_GET['date'])?>";
        let session = "<?=($_GET['session']);?>";
        console.log("訂了");
        
        $.post("./api/order.php",{seats,movie,date,session},function(res){
            console.log(res);
            $('#res').html(res);
            $('#booking').hide();
            $('#order').hide();
            $('#res').show();
        })

    })

</script>