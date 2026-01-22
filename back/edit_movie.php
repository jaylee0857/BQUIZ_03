<?php
    $movie=$Movie->find($_GET['id']);
    $date = explode('-',$movie['date']);
    $y = (int)$date[0];
    $m = (int)$date[1];
    $d = (int)$date[2];

?>

<div class="rb tab">
    <h2 class="ct">編輯院線片</h2>
    <form action="./api/save_movie.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>影片資料</td>
            <td>
                <div>
                    <label for="">片名: </label>
                    <input type="text" name="name" value="<?=$movie['name']?>">
                </div>
                <div>
                    分級: <label for=""></label>
                    <select name="level" id="">
                        <option value="1" <?=($movie['level'] == 1)?"selected":""?>>普遍級</option>
                        <option value="2"  <?=($movie['level'] == 2)?"selected":""?>>輔導級</option>
                        <option value="3"  <?=($movie['level'] == 3)?"selected":""?>>保護</option>
                        <option value="4" <?=($movie['level'] == 4)?"selected":""?>>限制</option>
                    </select>
                </div>
                <div>
                    <label for="">片長:</label>
                    <input type="text" name="long_time" value="<?=$movie['long_time']?>">
                </div>
                <div>
                    <label for="">上映日期 : </label>
                    <select name="y" id="">
                        <option value="2026"  <?=(2026== $y)?"selected":""?>>2026</option>
                        <option value="2027" <?=(2027== $y)?"selected":""?>>2027</option>
                        <option value="2028" <?=(2028== $y)?"selected":""?>>2028</option>
                    </select>
                    <select name="m" id="">
                        <?php
                            for ($i=1; $i < 13; $i++) { 
                                $selected = ($i == $m) ?"selected":"";
                                echo "<option value=\"$i\" $selected>$i</option>";
                            }
                        ?>
                    </select>
                    <select name="d" id="">
                        <?php
                            for ($i=1; $i <= 31; $i++) { 
                                $selected = ($i == $d) ?"selected":"";
                                echo $selected;
                                echo "<option value=\"$i\" $selected>$i</option>";
                            }
                        ?>
                    </select>
                </div>
                <div>
                     <label for="">發行商:</label>
                    <input type="text" name="pub" value="<?=$movie['pub']?>">
                </div>
                <div>
                    <label for="">導演: </label>
                    <input type="text" name="dir" value="<?=$movie['dir']?>">
                </div>
                <div>
                     <label for="">預告電影:</label>
                    <input type="file" name="pre_movie">
                </div>
                <div>
                     <label for="">電影海報:</label>
                     <input type="file" name="poster">
                </div>
            </td>
        </tr>
        <tr>
            <td>劇情簡介</td>
            <td>
                <textarea name="intro" id="" cols="10" rows="10"> <?=$movie['intro']?></textarea>
            </td>
        </tr>
    </table>
    <div class="ct">
        <input type="hidden" name="id" value="<?=$_GET['id']?>">
        <input type="submit" value="修改">
        <input type="reset" value="重置">
    </div>
</form>
</div>