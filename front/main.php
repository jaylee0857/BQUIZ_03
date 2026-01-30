
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
        .lists{
            position: relative;
            height: 300px;
            display: flex;
            justify-content: center;

        }
        .list{
            position: absolute;

        }
        .list img{
            height: 200px;
        }
        .controls{
            display: flex;
           align-items: center;
            
            width: 100%;
            overflow: hidden;
        }

        
        .box{
            position: relative;
            overflow: hidden;
        }
        .btns{
            display: flex;
            gap:1px

        }
        .l{
            border-right: 15px solid black;
            border-top: 15px solid transparent;
            border-left: 15px solid transparent;
            border-bottom: 15px solid transparent;
        }
        .btns img{
            width: 80px;
            margin:0 5px;
        }

        .r{
            border-right: 15px solid transparent;
            border-top: 15px solid transparent;
            border-left: 15px solid black;
            border-bottom: 15px solid transparent;
        }
        
    </style>
    <div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
    <div class="rb tab" style="width:95%;">
        <div class="lists">
                <?php
                    $rows = $Poster->all(['sh'=>1]);
                    foreach ($rows as $row) :
                ?>
            <div class="list" data-ani="<?=$row['ani']?>">
                    <img src="./upload/<?=$row['img']?>" alt="">
                    <div class="ct"><?=$row['name']?></div>
            </div>
                <?php
                    endforeach
                ?>
        </div>
        <div class="controls">
            <!-- <img class="l" src="icon\arrow.jpg" alt=""> -->
            <div class="l"></div>
            <div class="box">
                <div class="btns">
                    <?php
                        // $rows = $Poster->all(['sh'=>1]);
                        foreach ($rows as $row) :
                    ?>
                    <div class="btn">
                        <img src="./upload/<?=$row['img']?>" alt="">
                        <div class="ct"><?=$row['name']?></div>
                    </div>
                    <?php
                        endforeach
                    ?>
                </div>
            </div>
            <!-- <img  class="r" src="icon\arrow.jpg" alt=""> -->
            <div class="r"></div>
        </div>
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
                <button onclick="location.href='?do=order&id=<?=$row['id']?>'">線上訂票</button>

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

<script>
    let now = 0;                        
    const t = 1000;                     

    $(".list").hide();                  
    $(".list").eq(now).show();      

    function list_trasitin(target) {
        const $lists = $(".list");
        const $cur = $lists.eq(now);

        const next = (target !== undefined) ? target : (now + 1) % $lists.length;
        if (next === now) return;

        const $next = $lists.eq(next);
        const ani = $next.data("ani");

        $lists.hide();

        if (ani == 1) {
            $cur.fadeOut(t, function () {
            $next.fadeIn(t);
            });
        } else if (ani == 2) {
            $cur.slideUp(t, function () {
            $next.slideDown(t);
            });
        } else {
            $cur.hide(t, function () {
            $next.show(t);
            });
        }

        now = next;
    }

    // ✅ 每 3 秒自動換一張
    let slider = setInterval(() => {
    list_trasitin();
    }, 3000);

    $(".btn").click(function () {
        clearInterval(slider);
        const idx = $(this).index();
        list_trasitin(idx);

        slider = setInterval(() => {
        list_trasitin();
        }, 3000);
    });

    $('.l, .r').click(function () {                         // 點左右按鈕
        const box = $('.box')[0];                             // 取得 box 的 DOM 元素

        const step = $('.btn').first().outerWidth(true);     // 一次滑動距離＝視窗寬度(一頁)
        console.log(step);
        
        const max  = box.scrollWidth - box.clientWidth;       // 最右邊界＝內容寬 - 視窗寬
        
        let next = box.scrollLeft;                            // 目前捲動位置
        console.log(next);
        
        if ($(this).hasClass('r')) next += step;              // 點右：往右捲
        else next -= step;                                    // 點左：往左捲

        if (next < 0) next = 0;                               // 不能小於 0
        if (next > max) next = max;                           // 不能超過最右邊界

        $('.box').animate({ scrollLeft: next }, 200); // 動畫捲動到 next
    });

</script>