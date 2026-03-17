<?php


?>

<form action="?do=booking" method="post">

    <table>
        <tr>
            <td>電影:</td>
            <td>
                <select name="movie_id" id="movie_id">

                 <?php
                    $today = date("Y-m-d");
                    $ondate = date("Y-m-d", strtotime("-2 day"));
                    $rows = $Movie->all(['sh'=>1], " AND `date` BETWEEN '$ondate' AND '$today' ");
                    foreach ($rows as $key => $row) {
                ?>

                    <option value="<?=$row['id']?>"><?=$row['name']?></option>
                        
                <?php
                    }
                ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>日期:</td>
            <td>
                <select name="movie_date" id="movie_date">

                </select>
            </td>
        </tr>
        <tr>
            <td>場次:</td>
            <td>
                <select name="movie_show_time" id="movie_show_time">

                </select>
            </td>
        </tr>
    </table>
<div class="ct">
    <input type="submit" value="確認">
    <input type="reset" value="重製">
</div>
</form>

<script>

<?php
    if (isset($_GET['id'])) {
?>
    $("#movie_id").val(`<?=$_GET['id']?>`)
<?php
    }
?>




get_date();
$("#movie_id").change(function(){
    get_date()
})

$("#movie_date").change(function(){
    get_show_time()

})
function get_date(){
    
    let movie_id = $("#movie_id").val();
    console.log(movie_id);

    $.post("./api/get_date.php",{movie_id},function(res){
        console.log(res);
        
        $("#movie_date").html(res);

        <?php
            if (isset($_GET['movie_date'])) {
        ?>
            $("#movie_date").val(`<?=$_GET['movie_date']?>`)
        <?php
            }
        ?>
        get_show_time()
    })
}

function get_show_time(){
    let movie_id = $("#movie_id").val();
    let movie_date = $("#movie_date").val();

    $.post("./api/get_show_time.php",{movie_id,movie_date},function(res){
        $("#movie_show_time").html(res);

        <?php
            if (isset($_GET['movie_show_time'])) {
        ?>
            $("#movie_show_time").val(`<?=$_GET['movie_show_time']?>`)
        <?php
            }
        ?>
    })

}

</script>