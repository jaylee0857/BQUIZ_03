<?php
    $id = $_GET['id'] ?? 1;
    $row = $Movie->find($id);
?>
<div class="tab rb" style="width:87%;">
<div style="background:#FFF; width:100%; color:#333; text-align:left">
    <video src="./upload/<?=$row['prev']?>" width="300px" height="250px" controls="" style="float:right;"></video>
    <font style="font-size:24px"> <img src="./upload/<?=$row['poster']?>" width="200px" height="250px"
        style="margin:10px; float:left">
    <p style="margin:3px">影片名稱 ：<?=$row['name']?>
    <a href="?do=order&id=<?=$row['id']?>">
        <input type="button" value="線上訂票" onclick=""
        style="margin-left:50px; padding:2px 4px" class="b2_btu">
    </a>

    </p>
    <p style="margin:3px">影片分級 ： <?=$row['level']?><img src="./icon/<?=$row['level']?>.png" style="display:inline-block;"></p>
    <p style="margin:3px">影片片長 ： 時/分</p>
    <p style="margin:3px">上映日期 2014/02/14</p>
    <p style="margin:3px">發行商 ： </p>
    <p style="margin:3px">導演 ： </p>
    <br>
    <br>
    <p style="margin:10px 3px 3px 3px; word-break:break-all"> 劇情簡介：<br>
    </p>
    </font>
    <table width="100%" border="0">
    <tbody>
        <tr>
        <td align="center"><input type="button" value="院線片清單" onclick="location.href='?'"></td>
        </tr>
    </tbody>
    </table>
</div>
</div>