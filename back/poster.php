<?php
    if (isset($_POST['ani'])) {
        $_SESSION['ani'] = $_POST['ani'];
    }
    
?>
<div class="rb tab">
    <h2 class="ct">預告片清單</h2>
    <form action="?do=poster" method="post">
        <select name="ani" id="">
            <option value="0" <?=($_SESSION['ani'] == 0)?"selected":""?>>淡入淡出</option>
            <option value="1" <?=($_SESSION['ani'] == 1)?"selected":""?>>滑入滑出</option>
            <option value="2" <?=($_SESSION['ani'] == 2)?"selected":""?>>縮放</option>
        </select>
        <input type="submit" value="變更動畫">
    </form>
    <form action="./api/edit_poster.php" method="post">
        <table>
            <thead>
                <td>預告片海報</td>
                <td>預告片片名</td>
                <td>預告片排序</td>
                <td>操作</td>
            </thead>
            <?php

                $rows = $Poster->all(" ORDER BY `rank`");
                foreach ($rows as $i => $row) :
            ?>
            <tr>
                <td><img width="100" src="./upload/<?=$row['img']?>" alt=""></td>
                <td><input type="text" name="name[]" id="" value="<?=$row['name']?>"></td>
                <td>
                    <input type="number" name="rank[]" id="" value="<?=$row['rank']?>">
                </td>
                <td>
                    <input type="hidden" name="id[]" value="<?=$row['id']?>">
                    <!-- 錯題: 沒有放value 根本送不到資料 -->
                    <input type="checkbox" name="sh[]" value="<?=$row['id']?>" <?=($row['sh'] == 1) ?"checked":""?>>顯示
                    <input type="checkbox" name="del[]"value="<?=$row['id']?>">刪除

                </td>
            </tr>
            <?php
                endforeach
            ?>
        </table>
        <div class="ct">
            <input type="submit" value="確定編輯">
            <input type="reset" value="重製">
        </div>
    </form>
    <hr>
    <h2 class="ct">新增預告片海報</h2>
    <form action="./api/add_poster.php" method="post">
        <table>
            <tr>
                <td>預告片海報: <input type="file" name="img" id=""></td>
                <td>預告片片名: <input type="text" name="name" id=""></td>
            </tr>
        </table>
        <div class="ct">
            <input type="submit" value="新增">
            <input type="reset" value="重製">
        </div>
    </form>
</div>

<script>

    $('.sw').click(function(){
        let sw = $(this).data("sw");
        let id = $(this).data("id");
        // 錯題: sw會共用所以要放table
        $.post("./api/sw.php?table=Poster",{sw,id},function(res){
            location.reload()
        })
    })
</script>