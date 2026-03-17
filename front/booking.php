<?php
    $id = $_POST['movie_id'];
    $name = $Movie->find($id)['name'];
    $date = $_POST['movie_date'];
    $show_time = $_POST['movie_show_time'];

?>
<style>
    .seat_box{
        display: flex;
        flex-wrap: wrap;
        width: 500px;
        margin: 0 auto;
    }
    .seat{
        width: 100px;
    }
</style>
<div class="seat_box">

<?php
    $rows = $Orders->all(['name'=>$name,'date'=>$date,'show_time'=>$show_time]);
    $total_seat = [];
    foreach ($rows as $key => $row) {
        $total_seat = array_merge($total_seat, json_decode($row['seat']));
    }
    // dd($total_seat);
    for ($i=0; $i <20 ; $i++) { 
?>
    <div class="seat">
        <?php
            if (!in_array($i,$total_seat)) {
        ?>
            <img src="./icon/03D02.png" alt="">
        <?php
            }else{
        ?>
            <img src="./icon/03D03.png" alt="">

        <?php
            }
        ?>
        <div>
            <?=floor($i/5)+1?>排 <?=($i%5)+1?>號
        </div>
        
        <?php
            if (!in_array($i,$total_seat)) {
        ?>
            <input class="s" type="checkbox" name="seat[]" value="<?=$i?>">
        <?php
            }
        ?>
    </div>

<?php
    }
?>
</div>


<hr>
<div>
    您選擇的電影是 <?=$name ?>
</div>
<div>
    您選擇的時刻是: <?=$date ?>  <?=$show_time ?>
</div>
<div>
    您已經勾選<span id="qt">0</span>張票，最多可以購買四張票
</div>

<a href="?do=order&id=<?=$id?>&movie_date=<?=$date?>&movie_show_time=<?=$show_time?>">
<input type="button" value="上一步" onclick="">
</a>

<input type="button" value="訂購" onclick="checkout()">


<script>
    let seat=[];

    $(".s").click(function(){
        console.log(this.checked);
        
        let i = $(this).val();
        if (this.checked) {
            if (seat.length >= 4) {
                alert("最多可以購買四張票")
                this.checked = false;
                console.log(321);
                
                return;
            }
            seat.push(i);
        }else{
            // 要回存!!!!!!!!!!!!!!!
            seat = seat.filter((e)=> e!=i )
        }
        console.log(seat);
        $('#qt').text(seat.length)

    })

    function checkout(){
        let name = `<?=$name?>`;
        let date = `<?=$date?>`;
        let show_time = `<?=$show_time?>`;
        let qt = seat.length;
        $.post("./api/checkout.php",{name,date,show_time,qt,seat},function(res){
            console.log(res);
            
            location.href="?do=checkout";

        })
    }

</script>