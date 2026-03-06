<div class="rb tab">
<h2>編輯院線片</h2>
<form action="./api/save_movie.php" method="post">
<p>影片資料:</p>
<table>
    <tr>
        <td>片名:</td>
        <td>
            <input type="text" name="name" id="">
        </td>
    </tr>
    <tr>
        <td>分級:</td>
        <td>
            <select name="level" id="">
                <option value="普遍級">普遍級</option>
                <option value="輔導級">輔導級</option>
                <option value="保護級">保護級</option>
                <option value="限制級">限制級</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>片長:</td>
        <td>
            <input type="text" name="time" id="">
        </td>
    </tr>
    <tr>
        <td>上映時間</td>
        <td>
            <select name="y" id="">
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
            </select>年
            <select name="m" id="">
                <?php
                    for ($i=1; $i < 13; $i++) { 
                        echo "<option value='$i'>$i</option>";
                    }
                ?>
            </select>月
            <select name="d" id="">
                <?php
                    for ($i=1; $i < 32; $i++) { 
                        echo "<option value='$i'>$i</option>";
                    }
                ?>
            </select>日
        </td>
    </tr>
    <tr>
        <td>發行商:</td>
        <td>
            <input type="text" name="pub" id="">
        </td>
    </tr>
    <tr>
        <td>導演:</td>
        <td>
            <input type="text" name="dir" id="">
        </td>
    </tr>
    <tr>
        <td>預告影片:</td>
        <td>
            <input type="file" name="prev" id="">
        </td>
    </tr>
    <tr>
        <td>電影海報:</td>
        <td>
            <input type="file" name="poster" id="">
        </td>
    </tr>
    <tr>
        <td>劇情簡介:</td>
        <td>
            <textarea name="intro" id=""></textarea>
        </td>
    </tr>
</table>

<input type="hidden" name="id" value="<?=$_GET['id']?>">
<input type="submit" value="編輯">
<input type="reset" value="重製">


</form>

</div>