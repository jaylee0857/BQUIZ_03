<style>
    .table-wrap{ 
        max-height:300px; 
        overflow-y:auto; 
    }
    thead tr{
        position: sticky;
        top: 0;
        background: black;

    }

</style>
<div class="rb tab">
    <div class="ct">
        預告片清單
    </div>
    <form action="./api/edit_poster.php" method="post">

    <div class="table-wrap">
        <table style="width:100%">
            <thead>
            <tr>
                <td width="20%">預告片海報</td>
                <td width="25%">預告片片名</td>
                <td width="15%">預告片排序</td>
                <td width="">操作</td>
            </tr>
            </thead>
            <tbody>
                <?php
                    $rows = $Poster->all(" ORDER BY `rank`");

                    // foreach ($rows as $key => $row) {

                    // // 上一筆 id（如果已經是第一筆，就用自己的 id）
                    // $prev_id = ($key > 0) ? $rows[$key - 1]['id'] : $row['id'];

                    // // 下一筆 id（如果已經是最後一筆，就用自己的 id）
                    // $next_id = ($key < count($rows) - 1) ? $rows[$key + 1]['id'] : $row['id'];

                    // }

                    foreach ($rows as $key=> $row) :
                        $prev_id = ($key > 0) ? $rows[$key - 1]['id'] : $row['id'];
                        $next_id = ($key < count($rows) - 1) ? $rows[$key + 1]['id'] : $row['id'];
                ?>
                <tr>
                    <td class="ct">
                        <img width="100px" src="../upload/<?=$row['img']?>" alt="">
                    </td>
                    <td>
                        <input type="text" name="name[]" value="<?=$row['name']?>">
                        
                    </td>
                    <td class="ct">
                        <input type="button" class="sw" data-sw="<?=$prev_id?>-<?=$row['id']?>" value="向上">
                        <input type="button" class="sw" data-sw="<?=$next_id?>-<?=$row['id']?>" value="向下">

                    </td>
                    <td>
                        <input type="checkbox" name="sh[]" id="" value="<?=$row['id']?>" <?=($row['sh'] == 1)?"checked":""?>>顯示
                        <input type="checkbox" name="del[]" id="" value="<?=$row['id']?>">刪除
                        <input type="hidden" name="id[]" value="<?=$row['id']?>">
                        <select name="ani[]" id="">
                            <option value="1" <?=($row['ani'] == 1 ?"selected":"")?>>淡入淡出</option>
                            <option value="2" <?=($row['ani'] == 2 ?"selected":"")?>>滑入滑出</option>
                            <option value="3" <?=($row['ani'] == 3 ?"selected":"")?>>縮放</option>

                        </select>
                    </td>
                </tr>
                <?php
                endforeach
                ?>
            </tbody>
        </table>
    </div>

        <div class="ct">
                <input type="submit" value="確認編輯">
                <input type="reset" value="重製">
        </div>
    </form>
    <hr>
    <div>
        <div class="ct">
        新增預告片清單
        </div>
        <form action="./api/add_poster.php" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>預告片海報:</td>
                    <td>
                        <input type="file" name="img" id="">
                    </td>
                    <td>
                        預告片片名:
                    </td>
                    <td>
                        <input type="text" name="name">
                    </td>
                </tr>
            </table>
            <div>
                <input type="submit" value="新增">
                <input type="reset" value="重製">
            </div>
        </form>
    </div>
</div>

<script>
    $(".sw").click(function(){
        let ids = $(this).data("sw").split("-")
        console.log(ids);
        
        $.post("./api/sw.php",{ids},(res)=>{
            location.reload();
            console.log(res);
            
        }) 
    })
</script>