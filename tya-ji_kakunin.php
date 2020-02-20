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
$username=$_POST['uname'];
$tyaji=$_POST['tyaji'];

if($_POST['tyaji']){

$query="select * from money_tab where userid=$userid";
$stmt = $dbh->query($query);
$rec = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($rec as $row) {
	$bal = $row['balance'];
?>

<body>
  <center>

  <font size="4">
		<h1>チャージ確認</h1>
	</font>

<?php


  echo "以上の内容で登録して宜しいですか。<br>";
  echo "<br>";
  echo "残高　：　$bal <br>";
  echo "入金　：　$tyaji<br>";

    $a=$bal+$tyaji;
    echo "残高合計　：　$a<br>";


 ?>


 <form action="tya-ji_kanryo.php" method="post">
    <input type="hidden" name="uid" value="<?php echo $userid; ?>">
    <input type="hidden" name="uname" value="<?php echo $username; ?>">
    <input type="hidden" name="tyaji" value="<?php echo $tyaji; ?>">
    <input type="hidden" name="balance" value="<?php echo $a; ?>">

    <input type="submit" value="チャージ" name="bt">
 </form>

 </center>
</body>
</html>


<?php 
}
}else{

?>



<body>
  <center>

  <font size="4">
		<h1>チャージ確認</h1>
	</font>

  <?php
  echo "<br>";
  echo "<br>";
  echo "入力してください。<br>";
}
?>

<br>
<br>
   <p><a href="home_tab.php" >戻る</a></p>
 </center>
</body>
</html>