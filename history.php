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

?>


<body>
<style type="text/css">
<<<<<<< HEAD
=======

 
>>>>>>> 1caedc9d7248cd7ee8a9484a4ffca68986c3331f
body{
  background-color: #EAEAEA ;
  color:#000000;
}

table{
  background-color: #FFFFFF;
  border-collapse:collapse;
  margin:0 auto;
}
th{
  background-color: #FFFFFF;
  color:#444444;
}
td{
  border-bottom:1px dashed #444444;
}
th,tr:last-child td{
  background-color: #FFFFFF;
  border-bottom:2px solid #444444;
}
td,th{
  background-color: #FFFFFF;
  padding:10px;
}

</style>
  <center><font size="3">
      <h1>履歴一覧</h1>




<?php
$username=$_SESSION['username'];
$userid=$_SESSION['userid'];



$query = "SELECT shop_tab.shop_name,product_tab.product_name,product_tab.product_price, history_tab.price, history_tab.balance,history_tab.datetime FROM history_tab left outer join shop_tab on history_tab.shopid=shop_tab.shopid left outer join product_tab on history_tab.productid=product_tab.productid where history_tab.userid = $userid order by datetime asc";
// 表示してSQLを確認 echo $query
$stmt = $dbh->query($query);
$rec = $stmt->fetchAll(PDO::FETCH_ASSOC);


// $query2 = "SELECT * FROM history_tab where userid = $userid";
// // 表示してSQLを確認 echo $query
// $stmt2 = $dbh->query($query2);
// $rec2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r($rec2);
// echo "</pre>";

echo "<h2>使用履歴</h2>";
echo "<table border='1'>";

  echo "<tr><th></th><th>店名</th><th>商品名</th><th>支払額</th><th>残高</th><th>日時</th></tr>";
$i = 1;
foreach ($rec as $row){
    //変数への格納
    $shopid=$row['shopid'];
    $productid=$row['productid'];
    $datetime=$row['datetime'];
    $shop_name=$row['shop_name'];
    $product_name=$row['product_name'];
    $product_price=$row['product_price'];
    $price=$row['price'];
    $balance=$row['balance'];

    echo "<tr><td> $i </td>";
    echo "<td> $shop_name </td>";
    echo "<td> 　$product_name </td>";
    if(isset($price)){
      echo "<td> $price </td>";
    }else {
      echo "<td> $product_price </td>";
    }
    echo "<td> $balance </td>";
    echo "<td> 　$datetime </td></tr>";
  $i++;
}

  echo"</table>";

  $query2 = "select * from charge_tab where userid=$userid";
  // 表示してSQLを確認 echo $query
  $stmt2 = $dbh->query($query2);
  $rec2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

  echo "<br>";
  echo "<br>";
  echo "<h2>チャージ履歴</h2>";
echo "<table border='1'>";
  echo "<tr><th></th><th>チャージ金額</th><th>残高</th><th>日時</th></tr>";

  $i = 1;
  foreach ($rec2 as $row2){
      //変数への格納
      $price=$row2['price'];
      $balance=$row2['balance'];
      $datetime=$row2['datetime'];
      
  
      echo "<tr><td> $i </td>";
      echo "<td> $price </td>";
      echo "<td> 　$balance </td>";
      echo "<td> 　$datetime </td></tr>";
    $i++;
  }
  
    echo"</table>";

?>





<br>
	<p><a href="home_tab.php">ホームへ</a>　</p>
  </center>
</div>
</body>
</html>
