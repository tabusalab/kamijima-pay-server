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

$query="select * from money_tab where userid=$userid";
$stmt = $dbh->query($query);
$rec = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($rec as $row) {
	$bal = $row['balance'];
?>


<body>
  <center>

	<font size="4">
		<h1>チャージ</h1>
	</font>
    <style type="text/css">

 
body{
  background-color: #EAEAEA ;
  color:#000000;
}

.button{
  display: block;
  text-decoration: none;
  height:35px;
  width: 120px;
  line-height: 37px;
  text-align: center;
  color:  #FC9D9D;
  border:solid 1px  #FC9D9D;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
  font-weight: bold;
}
.button:hover{
  background: #FC9D9D;
  color:white;
}
.button_wrapper{
 text-align:center;
}
           </style>
<br>

<?php
    echo "残高 : $bal";
}
?>

<form action="tya-ji_kakunin.php" method="post">
    <input type="hidden" name="uid" value="<?php echo $userid; ?>">
    <input type="hidden" name="uname" value="<?php echo $username; ?>">
    
<br>

    <p>金額 <input type="text" name="tyaji" size="8">円</p>
    
<br>
	<p><input type="submit" name="bt" value="チャージ" class="button"></p>

</form>

<br>
	<p><a href="home_tab.php">ホームへ</a>　


    </center>
</body>
</html>