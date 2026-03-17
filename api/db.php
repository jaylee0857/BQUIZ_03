<?php
session_start();
date_default_timezone_set("Asia/Taipei");

function dd($ary){
    echo "<pre>";
    print_r($ary);
    echo "</pre>";
}

function to($url){
    header("location: $url");
}

class DB{
    private $dns="mysql:host=localhost;dbname=db03_3;charset=utf8";
    private $table;
    private $pdo;

    private function array_to_sql($ary){
        $tmp = [];
        foreach ($ary as $key => $value) {
            $tmp[]="`$key`='$value'";
        }
        return $tmp;
    }

    function __construct($table){
        $this->table = $table;
        $this->pdo = new PDO ($this->dns,"root","");
    }

    function all(...$arg){
        $sql = "SELECT * FROM `{$this->table}` ";
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
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function find($id){
        $sql = "SELECT * FROM `{$this->table}` ";
        if (is_array($id)) {
            $tmp = $this->array_to_sql($id);
            $sql .= " WHERE " . join(" AND ",$tmp);
        }else{
            $sql .= " WHERE `id` = '{$id}'";
        }

        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    
    function del($id){
        $sql = "DELETE FROM `{$this->table}` ";
        if (is_array($id)) {
            $tmp = $this->array_to_sql($id);
            $sql .= " WHERE " . join(" AND ",$tmp);
        }else{
            $sql .= " WHERE `id` = '{$id}'";
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
        return $this->pdo->query($sql)->fetchColumn();
    }
    function sum($col,...$arg){
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

    function save($ary){
        if (isset($ary['id'])) {
            $id = $ary['id'];
            unset($ary['id']);
            $tmp = $this->array_to_sql($ary);
            $sql = "UPDATE `{$this->table}` SET ".join(",",$tmp)." WHERE `id` = $id";
        }else{
            $cols = join("`,`",array_keys($ary));
            $vals = join("','",$ary);
            $sql = "INSERT INTO `{$this->table}` (`$cols`) VALUES ('$vals')";
        }
        // dd($sql);
        return $this->pdo->exec($sql);
    }
}


$Poster = new DB("poster");
$Movie = new DB("movie");
$Orders = new DB("orders");


$_SESSION['ani'] = $_SESSION['ani'] ??1;

?>

