<style>
    .movie_item{
        width: 100%;
        display: flex;
        padding: 5px 0;
        border-bottom: 1px solid white;
    }
    .ctrl{
        display: flex;
        justify-content: space-between;
        
    }

    .img{
        width: 15%;
    }

    .level{
        width: 15%;
    }

    .box3{
        flex:1
    }
    .buttons{
        display: flex;
        justify-content: flex-end;
        
    }
    .buttons button{
        border-radius: 5px;
        margin: 0 10px;
    }
    #movie_box{
        max-height: 400px;
        overflow-y: scroll;
    }
    .img{
        img{
            width: 100%;
        }
    }
</style>

<div class="rb tab">
    <button onclick="location.href='?do=add_movie'">新增電影</button>
    <hr>
    <section id="movie_box">
        <?php
            $rows = $Movie->all(" ORDER BY `rank`");
            foreach ($rows as $key=> $row) :
                $prev_id = ($key > 0) ? $rows[$key - 1]['id'] : $row['id'];
                $next_id = ($key < count($rows) - 1) ? $rows[$key + 1]['id'] : $row['id'];
        ?>
        <div class="movie_item">
            <div class="img">
                <img src="./upload/<?=$row['poster']?>" alt="">
            </div>
            <div class="level">
                分級: <img src="./icon/<?=$row['level']?>.png" alt="">
            </div>
            <div class="box3">
                <div class="ctrl">
                    <div >片名: <?=$row['name']?></div>
                    <div >片長: <?=floor($row['long_time']/60)?>:<?=($row['long_time']%60)?></div>
                    <div >上映時間: <?=$row['date']?></div>
                </div>
                <div class="buttons">
                    <button onclick="toggle_show(<?=$row['id']?>)"><?=($row['sh'] == 1) ?"顯示":"隱藏"?></button>
                    <input type="button" class="sw" data-sw="<?=$prev_id?>-<?=$row['id']?>" value="向上">
                    <input type="button" class="sw" data-sw="<?=$next_id?>-<?=$row['id']?>" value="向下">
                    <button onclick="location.href='?do=edit_movie&id=<?=$row['id']?>'">編輯電影</button>
                    <button onclick="location.href='api/del_movie.php?id=<?=$row['id']?>'">刪除電影</button>
                </div>
                <div>
                    劇情介紹: <?=$row['intro']?>
                </div>
            </div>
        </div>
        <?php
            endforeach;
        ?>
    </section>

</div>

<script>
    function toggle_show(id){
        $.post("./api/toggle_show.php",{id},function(){
        location.reload();
    })
    }


</script>
<script>
    $(".sw").click(function(){
        let ids = $(this).data("sw").split("-")
        console.log(ids);
        
        $.post("./api/sw.php?table=Movie",{ids},(res)=>{
            location.reload();
            console.log(res);
            
        }) 
    })
</script>