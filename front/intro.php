
<?php
  $row = $Movie->find($_GET['id']);
  $leve_table=["","普遍級","輔導級","保護級","限制級"];
?>
  <div class="tab rb" style="width:87%;">
    <div style="background:#FFF; width:100%; color:#333; text-align:left">
      <video src="./upload/<?=$row['pre']?>" width="300px" height="250px" controls="" style="float:right;"></video>
      <font style="font-size:24px"> <img src="./upload/<?=$row['poster']?>" width="200px" height="250px"
          style="margin:10px; float:left">
        <p style="margin:3px">影片名稱 ： <?=$row['name']?>
          <input type="button" value="線上訂票" onclick="location.href='?do=order&id<?=$row['id']?>'"
            style="margin-left:50px; padding:2px 4px" class="b2_btu">
        </p>
        <p style="margin:3px">影片分級 ： <img src="./icon/<?=$row['level']?>.png" style="display:inline-block;"><?=$leve_table[$row['level']]?></p>
        <p style="margin:3px">影片片長 ：  <?=floor($row['long_time']/60)?>:<?=($row['long_time']%60)?>
        <p style="margin:3px">上映日期 <?=$row['date']?></p>
        <p style="margin:3px">發行商 ： <?=$row['pub']?></p>
        <p style="margin:3px">導演 ： <?=$row['dir']?></p>
        <br>
        <br>
        <p style="margin:10px 3px 3px 3px; word-break:break-all"> 劇情簡介：<br>
        </p>
      </font>
      <table width="100%" border="0">
        <tbody>
          <tr>
            <td align="center"><input type="button" value="院線片清單" onclick="location.href='?do=main'"></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
