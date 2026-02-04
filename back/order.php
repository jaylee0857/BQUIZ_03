<style>
  table { 
    width: 100%;
    border-collapse: collapse; /* 讓線條不要變成雙線 */
  }
  td {
    border-bottom: 1px solid #ccc;   /* 每格的邊框 */
  }
</style>

<div class="rb tab">
    <h2 class="ct">訂單清單</h2>
    <div style="display:flex;">
        <div>
            快速刪除
        </div>
        <div>
            <input type="radio" name="type" id="typeDate" value="date" checked> 依照日期
            <input type="text" name="date" id="date">
        </div>
        <div>
            <input type="radio" name="type" id="typeMoive"  value="movie"> 依照電影
            <select name="movie" id="movie">
                <?php
                    $rows = $Orders->all(" group by `movie`");
                    dd($rows);
                    foreach ($rows as $row) :
                ?>
                    <option value="<?=$row['movie']?>"><?=$row['movie']?></option>
                <?php
                    endforeach
                ?>
            </select>
        </div>
        <button onclick="del_q()">刪除</button>
    </div>
    <table>
    <tr>
        <td width="15%">訂單編號</td>
        <td width="15%">電影名稱</td>
        <td width="15%">日期</td>
        <td width="15%">場次時間</td>
        <td width="15%">訂購數量</td>
        <td width="15%">訂購位置</td>
        <td>操作</td>
    </tr>
    
    <?php
        $rows = $Orders->all(" ORDER BY `no` desc");
        foreach ($rows as $index => $row) :
    ?>
    <tr>
        <td><?=$row['no']?></td>
        <td><?=$row['movie']?></td>
        <td><?=$row['date']?></td>
        <td><?=$row['session']?></td>
        <td><?=$row['qt']?></td>
        <td>
        <?php
            $seats = explode(',', $row['seats']);
            foreach ($seats as $s) {
            $s = (int)$s;
            echo (floor($s/5) + 1) . "排" . (($s % 5) + 1) . "號<br>";
            }
        ?>
        </td>
        <td>
            <button onclick="del_odrer(<?=$row['id']?>)">刪除</button>
        </td>
    </tr>
    <?php
        endforeach
    ?>
</table>
</div>

<script>

    function del_odrer(id){
        if (confirm("你確定要刪除這筆資料?")) {
            $.post("./api/del_order.php",{id},function(res){
                // console.log('asdasd');
                // console.log(res);
                
                location.reload();
            })
        }
    }

    function del_q(){
        let type = $("input[name='type']:checked").val();
        let value;
        switch (type) {
            case 'date':
                    value = $("#date").val()
                break;
        
            default:
                    value = $("#movie").val()
                break;
        }
        if (confirm(`你確定要刪除${value}這筆些資料?`)) {
            $.post("./api/del_q.php",{type,value},function(res){

                location.reload();
            })
        }
    }
</script>