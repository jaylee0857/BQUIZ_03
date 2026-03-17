<style>
    .lists{
        height: 300px;
    }
    .ctrls{
        display: flex;
        align-items: center;
    }
    .box{
        display: flex;

        overflow: hidden;

    }


    .list img {
        width: 250px;
    }
    
    .card{
        padding:0 1px;
    }
    .card img {
        width: 88px;
        
    }
</style>
<div class="half" style="vertical-align:top;">
<h1>預告片介紹</h1>
<div class="rb tab" style="width:95%;">
        <div class="lists">
            <?php
                $rows = $Poster->all();
                foreach ($rows as $key => $row) {
            ?>
            <div class="list ct">
                    <img src="./upload/<?=$row['img']?>" alt="">
                    <div><?=$row['name']?></div>
            </div>
            <?php
                }
            ?>
        </div>
        <div class="ctrls">
            <img class="l" width="35px" src="./icon/l.png" alt="">
            <div class="box">
                <?php
    foreach ($rows as $key => $row) {
?>
                <div class="card">
                    <img src="./upload/<?=$row['img']?>" alt="">
                    <div><?=$row['name']?></div>
                </div>
                <?php
    }
?>
            </div>
            <img class="r" width="35px" src="./icon/r.png" alt="">
        </div>
</div>
</div>

<script>
    $('.list').hide()
    $('.list').eq(0).show()
    
    let now = 0;
    let t =1000;
    play_ani(1);

    function play_ani(next) {
        let ani = <?=$_SESSION['ani'];?>;
        let $now = $('.list').eq(now);
        let $next = $('.list').eq(next);

        if (ani == 1) {
            $now.fadeOut(t,function(){
                $next.fadeIn(t);
            })
        }
        if (ani == 2) {
            $now.slideUp(t,function(){
                $next.slideDown(t);
            })
        }

        if (ani ==3) {
            $now.hide(t,function(){
                $next.show(t);
            })
        }
        now =next;
    }

    let timer = setInterval(function(){
        next = (now+1) % $('.list').length;
        play_ani(next);
    },3000)

    $(".r,.l").click(function(){
        let dir = $(this).hasClass("r")?90:-90;
        $(".box")[0].scrollBy(dir,0)
    })
    $(".card").click(function(){
        clearInterval(timer);
        $('.list').hide()
        now = $(this).index();
        play_ani(now);
        timer = setInterval(function(){
            next = (now+1) % $('.list').length;
            play_ani(next);
        },3000)
        
        // let html = $(this).html();
        // $('.list').html(html)
    })
</script>





<style>
    .content{
        display: flex;
        flex-wrap: wrap;
    }

    .movie{
        width: 46%;
    }
</style>


<div class="half">
<h1>院線片清單</h1>
<div class="rb tab" style="width:95%;">
    <div class="content">

    <?php
        $today = date("Y-m-d");
        $ondate = date("Y-m-d", strtotime("-2 day"));

        $div =4;
        $total = $Movie->count(['sh'=>1]);
        $now =  $_GET['p']??1;
        $pages = ceil($total/$div);
        $start= ($now-1)*$div;
        $rows = $Movie->all(['sh'=>1], " AND `date` BETWEEN '$ondate' AND '$today' LIMIT $start,$div");
        foreach ($rows as $key => $row) {
    ?>
                <div class="movie">
                    <div>
                        <img width="100px" src="./upload/<?=$row['img']?>" alt="">
                    </div>
                    <div>
                        <div><?=$row['name']?></div>
                        <div>分級: <?=$row['level']?></div>
                        <div>上映日期:<?=$row['date']?></div>

                    </div>
                    <div>
                        <a href="?do=detail&id=<?=$row['id']?>">
                            <input type="button" value="劇情簡介" onclick="">
                        </a>
                        <a href="?do=order&id=<?=$row['id']?>">
                            <input type="button" value="線上訂票" onclick="">
                        </a>
                    </div>
                </div>
    <?php
        }
    ?>
    </div>
    <?php
        if ($now >1) {
            $prev = $now -1;
            echo "<a href='?p=$prev'> < </a>";
        }
        for ($i=1; $i <=$pages ; $i++) { 
            $size = ($i == $now )?"24px":"16px";
            echo "<a style='font-size:$size' href='?p=$i'> $i </a>";

        }

        if ($now < $pages) {
            $prev = $now +1;
            echo "<a href='?p=$prev'> > </a>";
        }
    ?>
    
</div>
</div>