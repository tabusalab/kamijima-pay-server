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

$query="select * from money_tab where userid=$userid";
$stmt = $dbh->query($query);
$rec = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang = "ja">

<head>
        <title>上島Pay</title>
</head>


<body>
  <center>


  <font size="4">
		<h1>チャージ確認</h1>
	</font>

<?php

if($_POST['tyaji']){
  echo "以上の内容で登録して宜しいですか。<br>";
  echo "<br>";
  $name=$_POST['tyaji'];
  echo "残高　：　$bal <br>";
  echo "入金　：　$tyaji<br>";

  $x=5;

$y=2.5;

$a=(8*$x+3*$y)/(5*$x);

 ?>


 <form action="tya-ji_kanryo.php" method="post">
   <p>
     <input type="hidden" name="tyaji" value="<?php echo $tyaji; ?>">
   </p>
   <input type="submit" value="チャージ" name="bt">
 </form>

 <?php
 
}else{
  echo "<br>";
  echo "<br>";
  echo "入力してください。<br>";
}

  ?>

<br>
<br>
   <p><a href="tya-ji.php" >戻る</a></p>
 </center>
</body>
</html>