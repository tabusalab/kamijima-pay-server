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



<body>
	<center>
	<font size="5">
		<h1>上島Pay</h1>
	</font>

	<!-- 使える店舗一覧 -->


	<table border="1" >
	<tbody>
	<tr><th style="width:25%">店名</th></tr>
	<?php
		$query5="select * from shop_tab";
		$stmt5 = $dbh->query($query5);
		$rec = $stmt5->fetchAll(PDO::FETCH_ASSOC);

		foreach($rec as $row ){
			$shop=$row['shop_name'];

			echo "<tr><td>$shop</td></tr>";
		}

	?>
	</tbody>
	 </table>

<?php if(isset($_SESSION['username'])) : ?>
	<p>ようこそ、<?php echo $n ?>さん！</p>

	<form action="tya-ji.php" method="post">
		<input type="hidden" name="uid" value="<?php echo $id; ?>">
		<input type="hidden" name="uname" value="<?php echo $n; ?>">
		<p>
			<br>
			<br>
			<button type="submit" name="tya-ji" >チャージ</button>
			<br>
			<br>
	</form>
	<form action="history.php" method="post">
		<input type="hidden" name="uid" value="<?php echo $id; ?>">
		<input type="hidden" name="uname" value="<?php echo $n; ?>">
			<button type="submit" name="rireki" >履歴</button>
		</p>
	</form>
	<p><a href="./logout.php?token=<?=h(generate_token())?>">ログアウト</a></p>
<?php else : ?>
	<p><a href="./login.php">ログイン</a></p>
<?php endif;?>
</center>
</body>
</html>
