<?php
include_once "db.php";
dd($_POST);

    foreach ($_POST['id'] as $key => $id) {
        
        if (!empty($_POST['del']) && in_array($id,$_POST['del'])) {
            $Poster->del($id);
        }else{
            $row = $Poster->find($id);
            // dd($_POST);
            // dd($row);
            $row['name'] = $_POST['name'][$key];
            $row['rank'] = $_POST['rank'][$key];

            $row['sh'] = (!empty($_POST['sh']) && in_array($id,$_POST['sh'])) ?1:0;
            // 錯題: 沒有指定$key 導致資料沒有放到對應的欄位
            // 錯題: 但 $_POST 的第一層 Key 是你定義的 name 屬性（例如 ani），第二層才是 $key
            // $row['ani'] = $_POST[$key]['ani'];
            $Poster->save($row);
        }
    }
    to("../back.php?do=poster")
?>