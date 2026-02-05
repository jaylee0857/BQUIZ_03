<h3 class="ct">線上訂票</h3>
<div id="order">
    <form action="">
        <table>
            <tr>
                <td>電影:</td>
                <td>
                    <select name="movie" id="movie">
                        <?php
        
                            $select_id = $_GET['id'] ?? 0;
                            $today = date("Y-m-d");
                            $ondate = date("Y-m-d" , strtotime("-2 days"));
                            $rows=$Movie->all(['sh'=>1]," && `date` between '$ondate' AND '$today'");
                            foreach ($rows as $row) :
                        ?>
                            <option value="<?=$row['id']?>" <?=($select_id==$row['id']) ? "selected":"" ?>> <?=$row['name']?> </option>
                        <?php
                            endforeach;
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>日期:</td>
                <td>
                    <select name="date" id="date">
        
                    </select>
                </td>
            </tr>
            <tr>
                <td>場次</td>
                <td>
                    <select name="session" id="session">
        
                    </select>
                </td>
            </tr>
        </table>
        <div class="ct">
                <input id="order_start" type="button" value="送出">
                <input type="reset" value="重置">
        </div>
    </form>
</div>

<div id="booking" style="display:none">

</div>

<div id="res" style="display:none">

</div>

<script>

    $('#order_start').click(function(){
        $('#booking').show();
        $('#order').hide();
        $('#res').hide();

        let movie_id = $('#movie').val(); //id
        let date = $('#date').val(); // Y-m-d
        let session = $('#session').val(); // 14:00 ~ 16:00


        $.get("front/booking.php",{movie_id,date,session},function(booking){
            $('#booking').html(booking)
                            
            $('#booking_start').click(function(){
                $('#booking').hide();
                $('#order').show();
                $('#res').hide();
            })
        
            // $('#res_start').click(function(){
            //     $('#booking').hide();
            //     $('#order').hide();
            //     $('#res').show();
            // })

        })
    })
    

    // 選場次
    $("#movie").change(function(){
        let movie_id = $(this).val();
        selectDate(movie_id)
    })

    $("#date").change(function(){
        selectSession()
    })

    function selectDate(movie_id) {
        console.log(movie_id);
        $.get("./api/get_movie_date.php",{movie_id},function(res){
            $('#date').html(res);
            selectSession();

        })
    }

    function selectSession(){
        let movie_id = $('#movie').val();
        let date = $('#date').val()

        $.get("./api/get_session.php",{movie_id,date},function(res){
            $('#session').html(res);
        })
    }

    selectDate($("#movie").val());
    // 場次結束
</script>