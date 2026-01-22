
    <style>
        .movie_box{
            display: flex;
             flex-wrap: wrap;
            justify-content: space-between;

        }
        .movie_item{
            width: 45%;
            padding: 5px;
            border: 1px solid white;
            margin: 0 0 5px 0;
        }
        
    </style>
    <div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
        <div class="rb tab" style="width:95%;">

         </div>
    </div>
    <div class="half">
    <h1>院線片清單</h1>
    <div class="rb tab movie_box" style="width:95%;">
        <?php
            $leve_table=["","普遍級","輔導級","保護級","限制級"];
            
            $today = date("Y-m-d");
            $ondate = date("Y-m-d" , strtotime("-2 days"));
            $total = $Movie->count(['sh'=>1]," && `date` between '$ondate' AND '$today'");
            $div = 4;
            $pages=ceil($total/$div);
            $now=$_GET['p']??1;
            $start = ($now-1)*$div;
            $rows=$Movie->all(['sh'=>1]," && `date` between '$ondate' AND '$today' order by `rank` limit $start,$div");
            foreach ($rows as $row) :
        ?>
        <div class="movie_item">
            <div>電影名稱: <?=$row['name']?></div>
            <div style="display:flex;margin:5px 0;justify-content: space-between;">
                <a style="width:50%" href="?do=intro&id=<?=$row['id']?>">
                    <img width="100%" src="./upload/<?=$row['poster']?>" alt="">
                </a>
                <div>
                    <div>分級: <br> <img width="20px" src="./icon/<?=$row['level']?>.png" alt=""> <?=$leve_table[$row['level']]?></div>
                    <div>上映日期 : <br> <?=$row['date']?></div>
                </div>
            </div>
            <div class="ct">
                <button onclick="location.href='?do=intro&id=<?=$row['id']?>'">劇情簡介</button>
                <button>線上訂票</button>

            </div>
        </div>
        <?php
            endforeach;
        ?>
        <div style="width:100%" class="ct">
            <?php
                if ($now>1) {
                    $prev=$now-1;
                    echo "<a href=\"?p=$prev\"> < </a>";
                }
                for ($i=1; $i <= $pages ; $i++) { 
                    echo "<a href=\"?p=$i\"> $i </a>";
                }

                if ($now<$pages) {
                    $next=$now+1;
                    echo "<a href=\"?p=$next\"> > </a>";
                }

            ?>
        </div>
    </div>
    </div>