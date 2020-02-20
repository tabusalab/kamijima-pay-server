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



$n = "";
if(isset($_SESSION['username'])){
	$username = $_SESSION['username'];
	try {
		$query="select * from user_tab where username='$username'";
		$stmt = $dbh->query($query);
		$rec = $stmt->fetchAll(PDO::FETCH_ASSOC);

		foreach ($rec as $row) {
			$id = $row['userid'];
			$n = $row['username'];
		}
	}catch(PDOException $e){
        echo $e->getMessage();
        exit();
    }
} 

?>

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
    

table{
  background-color: #FFFFFF;
  border-collapse:collapse;
  margin:0 auto;
  width: 300px;
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


<body>
	<center>
	<font size="5">
		<h1>上島Pay</h1>
	</font>

	<!-- 使える店舗一覧 -->

	<br>

	<table border="1" >
	<tr><th>店名</th></tr>
	<?php
		$query5="select * from shop_tab";
		$stmt5 = $dbh->query($query5);
		$rec = $stmt5->fetchAll(PDO::FETCH_ASSOC);

		foreach($rec as $row ){
			$shop=$row['shop_name'];

			echo "<tr><td>$shop</td></tr>";
		}

	?>
	

	 </table>
	 <br>

<?php if(isset($_SESSION['username'])) : ?>
	<p>ようこそ、<?php echo $n ?>さん！</p>

	<form action="tya-ji.php" method="post">
		<input type="hidden" name="uid" value="<?php echo $id; ?>">
		<input type="hidden" name="uname" value="<?php echo $n; ?>">
		<p>
			<br>

			<button type="submit" name="tya-ji" class="button">チャージ</button>

			<br>
			<br>
	</form>
	<form action="history.php" method="post">
		<input type="hidden" name="uid" value="<?php echo $id; ?>">
		<input type="hidden" name="uname" value="<?php echo $n; ?>">
			<button type="submit" name="rireki" class="button">履歴</button>
		</p>
	</form>
	<br>
	<p><a href="./logout.php?token=<?=h(generate_token())?>">ログアウト</a></p>
<?php else : ?>
	<p><a href="./login.php">ログイン</a></p>
<?php endif;?>
</center>
</body>
</html>
