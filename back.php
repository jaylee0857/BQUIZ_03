<?php
  include_once "./api/db.php";
  if (isset($_POST['acc'])) {
    dd($_POST);
    if ($_POST['acc'] == 'admin' && $_POST['pw'] == '1234') {
      $_SESSION['login'] = 1;
    }else{
      echo "<script>arert('帳號或是密碼錯誤')</script>";
    }
  }
?>

<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0055)?do=admin -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>影城</title>
  <link rel="stylesheet" href="css/css.css">
  <link href="./css/s2.css" rel="stylesheet" type="text/css">
  <script src="./js/jquery-3.4.1.min.js"></script>
</head>

<body>
  <div id="main">
    <div id="top" style=" background:#999 center; background-size:cover; " title="替代文字">
      <h1>ABC影城</h1>
    </div>
    <div id="top2"> <a href="index.php">首頁</a> <a href="index.php?do=order">線上訂票</a> <a href="#">會員系統</a> <a
        href="back.php">管理系統</a> </div>
    <div id="text"> <span class="ct">最新活動</span>
      <marquee direction="right">
        ABC影城票價全面八折優惠1個月
      </marquee>
    </div>
    <div id="mm">
      <?php
        if (isset($_SESSION['login'])){
      ?>

      <div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;">
          <a href="#">網站標題管理</a>| 
          <a href="#">動態文字管理</a>| 
          <a href="?do=poster">預告片海報管理</a>| 
          <a href="?do=movie">院線片管理</a>| 
          <a href="?do=order">電影訂票管理</a>
      </div>

      <?php
        $do=$_GET['do'] ?? 'main';
        $path = "./back/$do.php";
        if (file_exists($path)) {
          include $path;
        }else {
          include "./back/main.php";

        }
      ?>

      <?php
          }else{
      ?>
      <form action="?" method="post">
          <h2>管理登入</h2>
          <table widtd="60%" style="margin:auto;">
              <tr>
                  <td>帳號:</td>
                  <td>
                      <input type="text" name="acc">
                  </td>
              </tr>
              <tr>
                  <td>密碼:</td>
                  <td>
                      <input type="password" name="pw">
                  </td>
              </tr>
            </table>
            <div class="ct">
              <input type="submit" value="送出">
            </div>
      </form>
      <?php
          }
      ?>
    </div>
    <div id="bo"> ©Copyright 2010~2014 ABC影城 版權所有 </div>
  </div>
</body>

</html>