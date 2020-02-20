<?php

require_once __DIR__ . '/header.php';

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
$tya=$_POST['tyaji'];

$query="insert into charge_tab(userid,price,balance,datetime) values('$userid',$tya,$bal,cast(now() as datetime))";
$stmt = $dbh->query($query);

$query2="update money_tab set balance = $bal where userid ='$userid'";
$stmt2 = $dbh->query($query2);

?>


<body>
  <center>
    <font size="4">
  		<h1>チャージ完了</h1>
  	</font>

<br>
<br>
<p><a href="home_tab.php">ホームへ</a>　　　　
    </center>
</body>
</html>