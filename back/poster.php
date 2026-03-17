<h2 class="ct">預告片清單</h2>
<form action="./api/ani.php" method="post">
        <select name="ani" id="">
            <option value="1" <?=($_SESSION['ani'] == 1) ?"selected":""?>>淡入淡出</option>
            <option value="2" <?=($_SESSION['ani'] == 2) ?"selected":""?>>滑入滑出</option>
            <option value="3" <?=($_SESSION['ani'] == 3) ?"selected":""?>>縮放</option>
        </select>
    <input type="submit" value="編輯動畫">

</form>
<hr>
<form action="./api/edit_poster.php" method="post">
    <table>
        <tr>
            <td>預告片海報</td>
            <td>預告片片名</td>
            <td>預告片排序</td>
            <td>操作</td>
        </tr>
        <?php
            $rows = $Poster->all();
            foreach ($rows as $key => $row) {
        ?>
        <tr>
            <td>
                <img width="100px" src="./upload/<?=$row['img']?>" alt="">
            </td>
            <td>
                <?=$row['name']?>
            </td>
            <td>
                <input type="number" name="rank[]" id="" value="<?=$row['rank']?>">
            </td>
            <td>
                <input type="checkbox" name="sh[]" value="<?=$row['id']?>" <?=($row['sh'] == 1) ?"checked":""?>>顯示
                <br>
                <input type="hidden" name="id[]" value="<?=$row['id']?>">

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
<hr>
<form action="./api/add_poster.php" method="post">
        <table>
            <tr>
                <td>預告片海報: 
                    <input type="file" name="img" id="">
                </td>
                <td>
                    預告片片名:
                    <input type="text" name="name" id="">
                </td>
            </tr>
        </table>
        <div class="ct">
    <input type="submit" value="新增">
    <input type="reset" value="重製">
</div>
</form>