<h2 class="ct">訂單清單</h2>
        快速刪除: <input type="radio" name="type" value="date">依日期: <input type="text" name="date" id="date">
        <input type="radio" name="type" value="name">依電影:<input type="text" name="name" id="name">
<input type="button" value="刪除" onclick="del_all()">

<hr>
<table class="ct">
        <tr>
                <td>訂單編號</td>
                <td>電影名稱</td>
                <td>日期</td>
                <td>場次時間</td>
                <td>訂購數量</td>
                <td>訂購位置</td>
                <td>操作</td>
        </tr>
        <?php
            $rows = $Orders->all();
            foreach ($rows as $key => $row) {
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
                <td>
                        <input type="button" value="刪除" onclick="del_id(<?=$row['id']?>)">
                </td>
        </tr>

        <?php
            }
        ?>
</table>


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