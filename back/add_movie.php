<div class="rb tab">
    <h2 class="ct">新增院線片</h2>
    <form action="./api/save_movie.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>影片資料</td>
            <td>
                <div>
                    <label for="">片名: </label>
                    <input type="text" name="name">
                </div>
                <div>
                    分級: <label for=""></label>
                    <select name="level" id="">
                        <option value="1">普遍級</option>
                        <option value="2">輔導級</option>
                        <option value="3">保護</option>
                        <option value="4">限制</option>
                    </select>
                </div>
                <div>
                    <label for="">片長:</label>
                    <input type="text" name="long_time">
                </div>
                <div>
                    <label for="">上映日期 : </label>
                    <select name="y" id="">
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                    </select>
                    <select name="m" id="">
                        <?php
                            for ($i=1; $i < 13; $i++) { 
                                echo "<option value=\"$i\">$i</option>";
                            }
                        ?>
                    </select>
                    <select name="d" id="">
                        <?php
                            for ($i=1; $i < 31; $i++) { 
                                echo "<option value=\"$i\">$i</option>";
                            }
                        ?>
                    </select>
                </div>
                <div>
                     <label for="">發行商:</label>
                    <input type="text" name="pub">
                </div>
                <div>
                    <label for="">導演: </label>
                    <input type="text" name="dir">
                </div>
                <div>
                     <label for="">預告電影:</label>
                    <input type="file" name="pre">
                </div>
                <div>
                    電影海報: <label for=""></label>
                     <input type="file" name="poster">
                </div>
            </td>
        </tr>
        <tr>
            <td>劇情簡介</td>
            <td>
                <textarea name="intro" id="" cols="10" rows="10"></textarea>
            </td>
        </tr>
    </table>
    <div class="ct">
        <input type="submit" value="新增">
        <input type="reset" value="重置">
    </div>
</form>
</div>