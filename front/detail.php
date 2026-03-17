        <?php
            $row = $Movie->find($_GET['id']);
        ?>
        
        <div style="background:#FFF; width:100%; color:#333; text-align:left">
          <video src="./upload/<?=$row['mv']?>" width="300px" height="250px" controls="" style="float:right;"></video>
          <font style="font-size:24px"> <img src="./upload/<?=$row['img']?>" width="200px" height="250px"
              style="margin:10px; float:left">
            <p style="margin:3px">影片名稱 ： <?=$row['name']?>
                        <a href="?do=order&id=<?=$row['id']?>">
                            <input type="button" value="線上訂票" onclick="">
                        </a>
            </p>
            <p style="margin:3px">影片分級 ： <img src="./icon/<?=$row['level']?>.png" style="display:inline-block;"><?=$row['level']?> </p>
            <p style="margin:3px">影片片長 ： <?=$row['lone_time']?>分</p>
            <p style="margin:3px">上映日期 <?=$row['date']?></p>
            <p style="margin:3px">發行商 ： <?=$row['f']?></p>
            <p style="margin:3px">導演 ： <?=$row['d']?></p>
            <br>
            <br>
            <p style="margin:10px 3px 3px 3px; word-break:break-all"> 劇情簡介：<br>
            <?=$row['intro']?>
            </p>
          </font>
          <table width="100%" border="0">
            <tbody>
              <tr>
                <td align="center">
                    <a href="?"><input type="button" value="院線片清單"></a>
                    </td>
              </tr>
            </tbody>
          </table>
        </div>