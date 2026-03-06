<div class="rb tab">
<a href="?do=add_movie"><button>新增電影</button></a>
<hr>
<form action="./api/edit_movie.php" method="post">

<!-- movie複製poster就好 -->
<table>
<?php

    $rows = $Movie->all();
    foreach ($rows as $row) :
?>
    <tr>
        <td>
            <img width="50px" src="./upload/<?=$row['poster']?>" alt="">
        </td>
        <td>
            <div>片名:<?=$row['name']?></div>
            <div>分級:<?=$row['level']?></div>
            <div>片長:<?=$row['time']?></div>
            <div>上映時間:<?=$row['date']?></div>
        </td>
        <td>
            <?=nl2br($row['intro'])?>
        </td>
        <td>
            排序: <input type="number" name="rank[]" id="" value="<?=$row['rank']?>">
        </td>
        <td>
            顯示: <input type="checkbox" name="sh[]" id=""  value="<?=$row['id']?>"><br>
            刪除: <input type="checkbox" name="del[]" id=""  value="<?=$row['id']?>">
            <input type="hidden" name="id[]" value="<?=$row['id']?>">
        </td>
        <td>
            <a href="?do=edit_movie&id=<?=$row['id']?>">
                <input type="button" value="編輯">
            </a>
        </td>
    </tr>
    <?php
    endforeach
?>
</table>
    <input type="submit" value="確定編輯">
        <input type="reset" value="重製">
</form>
</div>