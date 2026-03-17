<h2 class="ct">院線片清單</h2>
<a href="?do=add_movie">
        <input type="button" value="新增電影" onclick="">

</a>

<hr>
<form action="./api/edit_movie.php" method="post">
    <table>
        <?php
            $rows = $Movie->all();
            foreach ($rows as $key => $row) {
        ?>
        <tr>
            <td>
                <img width="100px" src="./upload/<?=$row['img']?>" alt="">
            </td>
            <td>
                <?=$row['level']?>
                <img src="./icon/<?=$row['level']?>.png" alt="">
            </td>
            <td>
                <div>片名:<?=$row['name']?></div>
                <div>片長:<?=$row['lone_time']?>分</div>
                <div>上映時間:<?=$row['date']?></div>
                <div>劇情介紹:<?=$row['intro']?></div>
            </td>
            <td>
                排序:
                <input type="number" name="rank[]" id="" value="<?=$row['rank']?>">
            </td>
            <td>
                <a href="?do=edit_movie&id=<?=$row['id']?>">
<input type="button" value="編輯電影" onclick="">

                </a>
                <br>
                <input type="hidden" name="id[]" value="<?=$row['id']?>">
                <input type="checkbox" name="sh[]" value="<?=$row['id']?>" <?=($row['sh'] == 1) ?"checked":""?>>顯示
<br>

                <input type="checkbox" name="del[]" value="<?=$row['id']?>">刪除
            </td>
        </tr>
        <?php
            }
        ?>
    </table>
    <div class="ct">
    <input type="submit" value="確認">
    <input type="reset" value="清空">
</div>
</form>
