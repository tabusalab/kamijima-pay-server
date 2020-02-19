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

$userid=$_POST['userid'];
$pass=$_POST['pass'];

if($_POST['userid'] && $_POST['pass']){

$query="select * from user_tab where userid=$userid ";
$stmt = $dbh->query($query);
$rec = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($rec as $row) {
	$id = $row['userid'];
	$n = $row['username'];
	$p = $row['pass'];

	if ($id == $userid && $p == $pass) {

?>

<!DOCTYPE html>
<html lang = "ja">
<head>
	<title>上島Pay</title>
</head>

<body>
	<center>
	<font size="5">
		<h1>上島Pay</h1>
	</font>

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

</center>
</body>
</html>

<?php
    $cnt=1;
    break;
}}
}else if($cnt!=1){

?>

<!DOCTYPE html>
<html lang = "ja">
<center>

<head>
	<title>上島Pay</title>
</head>

  <body>
  	<h1>ログイン失敗</h1>
   
                <form action="login.php" method="POST">
                    <input type='submit' value='ログイン画面へ' ></p>
                </form>


</center>
</body>
</html>
<?php } ?>

