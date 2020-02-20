<?php

// My SQL データベースの接続
define('DB_DATABASE','kpay');
define('DB_USERNAME','root');
define('DB_PASSWORD','tabusalab11!');
define('PDO_DSN','mysql:dbhost=52.156.45.138;dbname=kpay');

try{
    $dbh=new PDO(PDO_DSN , DB_USERNAME , DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $dbh->query('SET NAMES utf8'); //文字化けの解消
}catch(PDOException $e){
    echo $e->getMessage();
    exit();
}

$userid=$_POST['uid'];
$bal=$_POST['balance'];

$query="insert into charge_tab(userid,price,datetime) values('$userid',$bal,cast(now() as datetime))";
$stmt = $dbh->query($query);

$query="insert into charge_tab(userid,price,datetime) values('$userid',$bal,cast(now() as datetime))";
$stmt = $dbh->query($query);

?>





<!DOCTYPE html>
<html lang = "ja">

<head>
        <title>上島Pay</title>
</head>
<body>
  <center>
    <font size="4">
  		<h1>チャージ完了</h1>
  	</font>

<br>

<br>
<p><a href="home.php" class="border_spread_btn">買い物リスト一覧へ</a>　　　　
    </center>
</body>
</html>