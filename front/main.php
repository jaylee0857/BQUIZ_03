<div class="half" style="vertical-align:top;">
<h1>預告片介紹</h1>
<style>
    .lists{
        overflow: hidden;
        height: 381px;
    }
    .controls{
        display: flex;

        
    }
    .box{
        width: 400px;
        display: flex;
        overflow-x: hidden;
    }
    .card{
        
        img{
            width: 80px;
        }
    }

    /* 三角形 */
    .r {
    width: 0;
    height: 0;
    border: 25px solid;
    border-color: transparent transparent transparent yellow;
    }
    .l {
    width: 0;
    height: 0;
    border: 25px solid;
    border-color: transparent yellow transparent transparent;
    }
</style>
<div class="rb tab" style="width:95%;">
    <div id="abgne-block-20111227">
    <div class="lists">
        <?php
            $rows = $Poster->all(['sh'=>1], " ORDER BY `rank`");
            foreach ($rows as $row) :
        ?>

            <div class="list">
                <img src="./upload/<?=$row['img']?>" alt="">
                <div>
                    <?=$row['name']?>
                </div>
            </div>

        <?php
            endforeach
        ?>
    </div>
    <div class="controls">
        <div class="l"></div>
        <div class="box">
            <?php
                foreach ($rows as $row) :
            ?>
                <div class="card">
                    <img src="./upload/<?=$row['img']?>" alt="">
                    <div>
                        <?=$row['name']?>
                    </div>
                </div>

            <?php
                endforeach
            ?>
         </div>
        <div class="r"></div>
    </div>
    </div>
</div>
</div>


<script>
    console.log($(".list").length); 

    let now = 0;
    let t =500;
$(".list").hide();
$(".list").eq(now).show();

function ani (target){
    if (target == now) return
    let next = ( target == undefined ) ? (now+1) % $('.list').length : target;
    
    let $cur = $('.list').eq(now);
    let $next = $('.list').eq(next);
    let mode = <?=$_SESSION['ani']?>;
    
    console.log(mode);
    
    if (mode == 0) {
        $cur.fadeOut(t,function(){
            $next.fadeIn(t)
        })
    }
    if (mode == 1) {
        $cur.slideUp(t,function(){
            $next.slideDown(t)
        })
    }
    if (mode == 2) {
        $cur.hide(t,function(){
            $next.show(t)
        })
    }
    
    now = next;

}
let timer = setInterval(function(){
    ani()
},3000)

ani()
$(".card").click(function () {
  const idx = $(this).index();

  clearInterval(timer);   // 先停掉舊的
  ani(idx);               // 跳到你點的那張

  timer = setInterval(function () {  // 重開新的，注意：不要再用 let
    ani();
  }, 3000);
});

$(".r,.l").click(function(){
    let box = document.querySelector(".box");
    let dir  = $(this).hasClass("r") ? 1 : -1;
    let card = 80;
    box.scrollBy({
        left:card * dir,
        behavior: "smooth"
    })
})
</script>    


<style>
    .item_box{
        display: flex;
        flex-wrap: wrap;
    }
    .item{
        width: 45%;
    }
</style>
<div class="half">
<h1>院線片清單</h1>
<div class="rb tab item_box" style="width:95%;">

    <?php

    $from_date = date("Y-m-d", strtotime("-2 day"));
    $today_date = date("Y-m-d");

    $div = 4;
    $now = $_GET['p']??1;
    $total = $Movie->count(['sh'=>1]," AND `date` BETWEEN '$from_date' AND '$today_date'");
    $pages = ceil($total/$div);
    $start = ($now - 1 ) * $div;

    // 錯題: sql的value 一定要用單引號
        $rows = $Movie->all(['sh'=>1]," AND `date` BETWEEN '$from_date' AND '$today_date' LIMIT $start,$div");
        foreach ($rows as $row) :

    ?>
    <div class="item">
        <div>
            <a href="?do=detail&id=<?=$row['id']?>">
            <img height="100px" src="../upload/03B01.png" alt="">
            </a>

        </div>
        <div>
            <?=$row['name']?>
        </div>
        <div>
            分級: <?=$row['level']?>
            <img src="./icon/普遍級.png" alt="">
        </div>
        <div>
            <?=$row['date']?>
        </div>
        <div>
            <a href="?do=detail&id=<?=$row['id']?>">
                <button>劇情簡介</button>
            </a>
            <a href="?do=order&id=<?=$row['id']?>">
                <button>線上訂票</button>
            </a>
        </div>
    </div>
    <?php
    endforeach
?>

</div>
    <div class="ct">
        <?php
            if ($now > 1) {
                $pr = $now-1;
                echo "<a href='?p=$pr'> < </a>";
            }
        ?>
        
        <?php
            for ($i=1; $i <= $pages; $i++) { 
                $size = ($now == $i) ? "24px":"16px";
                echo "<a style='font-size:{$size}' href='?p=$i'>$i</a>";
            }
        ?>
        <?php
            if ($now < $pages) {
                $pr = $now+1;
                echo "<a href='?p=$pr'> > </a>";
            }
        ?>
    </div>
</div>