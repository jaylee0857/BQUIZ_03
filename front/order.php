<div class="">
    <div>電影:<select name="" id="movie_id">
        <?php
            $select_id = $_GET['id']??0;
            $from_date = date("Y-m-d", strtotime("-2 days"));
            $today_date = date("Y-m-d");
            $rows = $Movie->all(['sh'=>1]," AND `date` BETWEEN '$from_date' AND '$today_date'");
            foreach ($rows as $row) :
        ?>
            <option value="<?=$row['id']?>" <?=($row['id'] == $select_id ) ?"selected":""?>><?=$row['name']?></option>

        <?php
            endforeach
        ?>
    </select></div>
    <div>日期:<select name="" id="movie_date">

    </select></div>
    <div>場次:<select name="" id="movie_session">

    </select></div>
</div>

<div class="">
    <input type="submit" value="確定編輯">
    <input type="reset" value="重製">
</div>

<script>
    // 日期
    function select_date(){
        let movie_id = $('#movie_id').val();
        console.log(movie_id);
        $.post("./api/select_date.php",{movie_id},function(res){
            $('#movie_date').html(res);
            select_session ()
            

        })
    }

    //場次
    function select_session (){
        let movie_id = $('#movie_id').val();
        let movie_date = $('#movie_date').val();
        
        console.log(movie_date);
        $.post("./api/select_session.php",{movie_id,movie_date},function(res){
            $('#movie_session').html(res);

        })
        
    }


    $('#movie_id').change(function(){
        select_date()
    })
    $('#movie_date').change(function(){
        select_session()
    })
    select_date()
</script>