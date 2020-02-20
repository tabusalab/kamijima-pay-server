<?php

// My SQL データベースの接続
define('DB_DATABASE','kpay');
define('DB_USERNAME','root');
define('DB_PASSWORD','tabusalab11!');
define('PDO_DSN','mysql:dbhost=db2019@52.156.45.138;dbname=kpay');

try{
    $dbh=new PDO(PDO_DSN , DB_USERNAME , DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $dbh->query('SET NAMES utf8'); //文字化けの解消
}catch(PDOException $e){
    echo $e->getMessage();
    exit();
}

$userid=$_POST['uid'];
$query="select * from history_tab where userid=$userid";
// 表示してSQLを確認 echo $query;
$stmt = $dbh->query($query);
$rec = $stmt->fetchAll(PDO::FETCH_ASSOC);



echo "<table border='1'>";
  echo "<tr><th></th><th>店ID</th><th>商品名</th><th>支払額</th><th>チャージ</th><th>残高</th></tr>";

foreach ($rec as $row){
    //変数への格納
    $userid=$row['userid'];
    $shopid=$row['shopid'];
    $productid=$row['productid'];
    $price=$row['row'];
    $datetime=$row['datetime'];
   
    
    echo "<tr><td> $shopid </td>";
    echo "<td> 　$productid </td></tr>";
}
    



  echo"</table>";



?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <title>上島Pay</title>
<body>

 


  <center><font size="3">
      <h1>履歴一覧</h1>




  
  <p><a href="http://52.156.45.138/~db2019/i16041/homei16041.php">メニューに戻る</a></p>
</body>
</html>
