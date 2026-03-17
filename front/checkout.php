<h2 class="ct">感謝您的訂購</h2>
<table class="ct">
        <tr>
                <td>訂單編號</td>
                <td>電影名稱</td>
                <td>日期</td>
                <td>場次時間</td>
                <td>訂購數量</td>
                <td>訂購位置</td>
        </tr>
        <?php
            $row = $_SESSION['order'];
        ?>
        <tr>
                <td>
                    <?=$row['no']?>
                </td>
                <td><?=$row['name']?></td>
                <td><?=$row['date']?></td>
                <td><?=$row['show_time']?></td>
                <td><?=$row['qt']?></td>
                <td>
                    <?php
                        $s = json_decode($row['seat']);
                        foreach ($s  as $key => $i) {
                    ?>
                        <?=floor($i/5)+1?>排 <?=($i%5)+1?>號
                        <br>
                    <?php
                        }
                    ?>
                </td>

        </tr>
</table>
<div class="ct">
    <a href="?">
        <input type="submit" value="確認">
    </a>
</div>

<script>

    function del_id(id){
        $.post("./api/del_id.php",{id},function(){
        location.reload();
    })
    }


    function del_all(){
        let type = $("input[name=type]:checked").val()
        let val = '';
        if (type == 'date') {
            val = $('#date').val()
        }else{
            val = $('#name').val()

        }

        let ok = prompt("確定要刪除?")
    if (ok) {
                $.post("./api/del_all.php",{type,val},function(){
            location.reload();
        })
    }
    
        


        console.log(type);
        console.log(val);
        
    }

</script>