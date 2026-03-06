<?php

//錯題: session 沒啟動
//錯題: date時區沒有設定
//錯題: ob_start沒有開

session_start();
date_default_timezone_set("Asia/taipei");
function dd($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function to($url){
    header("location: $url");
}

class DB {

    private $table;
    //錯題: dsn寫錯, dbname就是考試要用的db名稱
    private $dsn= "mysql:host=localhost;dbname=db03_2;charset=utf8";
    //錯題: 忘記要設定pdo
    private $pdo;

    function __construct($table){
        $this->table = $table;
        $this->pdo = new PDO ($this->dsn,"root","");
    }

    private function array_to_sql($array){
        $tmp=[];
        foreach ($array as $key => $value) {
            $tmp[]="`$key` = '$value'";
        }
        return $tmp;
    }
    // 錯題:private 只能在 DB 類別內部呼叫；外部 $db->all() 會直接報錯
    function all(...$arg){
        // 錯題: PHP 在雙引號內解析物件或陣列要{}
        $sql = "SELECT * FROM `{$this->table}` ";
        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $tmp = $this->array_to_sql($arg[0]);
                // 錯題: WHERE後還要做join處理, 用AND把 WHERE條件的參數隔開組成字串;
                $sql .= " WHERE " . join(" AND ",$tmp);
            }else{
                //錯題: 如果不是陣列就是字串直接加入
                $sql .= $arg[0];
            }
        }
        if (isset($arg[1])) {
            $sql .= $arg[1];
        }
        // dd($sql);
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function find($id){
        $sql = "SELECT * FROM `{$this->table}` ";
        if (isset($id)) {
            //錯題:複製時有明顯錯誤 $arg沒有換
            if (is_array($id)) {
                //錯題:複製時有明顯錯誤 $arg沒有換
                $tmp = $this->array_to_sql($id);
                $sql .= " WHERE " . join(" AND ",$tmp);
            }else{
                //錯題: find 方法中的WHERH是不可少的 
                $sql .= " WHERE `id` = '{$id}'";
            }
        }

        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    function del($id){
        //錯題: del 拼錯字 是 DELETE *也不需要因為刪除必須一筆一筆資料刪除
        $sql = "DELETE FROM `{$this->table}` ";
        if (isset($id)) {
            if (is_array($id)) {
                $tmp = $this->array_to_sql($id);
                $sql .= " WHERE " . join(" AND ",$tmp);
            }else{
                $sql .= " WHERE `id` = '{$id}'";
            }
        }

        return $this->pdo->exec($sql);
    }

    function count(...$arg){
        $sql = "SELECT COUNT(*) FROM `{$this->table}` ";
        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $tmp = $this->array_to_sql($arg[0]);
                $sql .= " WHERE " . join(" AND ",$tmp);
            }else{
                $sql .= $arg[0];
            }
        }
        if (isset($arg[1])) {
            $sql .= $arg[1];
        }
        //錯題: COUNT的fetch描述要改 All->Column
        return $this->pdo->query($sql)->fetchColumn();
    }

    function sum($col,...$arg){
        //錯題: 從count複製來改sum記得要改SQL語法, 欄位記得要用`
        $sql = "SELECT SUM(`$col`) FROM `{$this->table}` ";
        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $tmp = $this->array_to_sql($arg[0]);
                $sql .= " WHERE " . join(" AND ",$tmp);
            }else{
                $sql .= $arg[0];
            }
        }
        if (isset($arg[1])) {
            $sql .= $arg[1];
        }
        return $this->pdo->query($sql)->fetchColumn();
    }

    function max($col,...$arg){
        $sql = "SELECT MAX(`$col`) FROM `{$this->table}` ";
        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $tmp = $this->array_to_sql($arg[0]);
                $sql .= " WHERE " . join(" AND ",$tmp);
            }else{
                $sql .= $arg[0];
            }
        }
        if (isset($arg[1])) {
            $sql .= $arg[1];
        }
        return $this->pdo->query($sql)->fetchColumn();
    }

    function save($array){
        if (isset($array['id'])) {
            $id = $array['id'];
            unset($array['id']);
            $tmp = $this->array_to_sql($array);
            //錯題: UPDATE 是用, 區隔要更新的每一筆資料, 跟WHERE需要用AND不一樣, WHERE前面要有空白WHERE 會黏在一起，SQL 直接語法錯, 欄位記得用``, 值記得用''
            $sql = "UPDATE `{$this->table}` SET ". join(",",$tmp). " WHERE `id` = '{$id}'";

        }else{
            //錯題: 先把cols以及vals字串處理好直接組sql語法
            $cols = join("`,`",array_keys($array));
            $vals = join("','",$array);
            //錯題: 組語法時前後的圓括弧以及符號要記得寫, 關鍵字VALUES打字打錯
            $sql = "INSERT INTO `{$this->table}` (`{$cols}`) VALUES ('{$vals}')";
        }
        //錯題: 語法組好了沒有return到資料庫
        return $this->pdo->exec($sql);
    }

}

$Poster = new DB ('poster');
$Movie= new DB ('movie');
$Orders= new DB ('orders');



$_SESSION['ani'] = $_SESSION['ani'] ??1;

?>