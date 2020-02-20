<?php
require_once __DIR__ . '/functions.php';
require_unlogined_session();
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

if($_POST['userid'] && $_POST['pass']){
  $userid=$_POST['userid'];
  $pass=$_POST['pass'];

	$query="select * from user_tab where userid=$userid ";
	$stmt = $dbh->query($query);
	$rec = $stmt->fetchAll(PDO::FETCH_ASSOC);

	foreach ($rec as $row) {
		$id = $row['userid'];
		$n = $row['username'];
		$p = $row['pass'];
		if ($id == $userid && $p == $pass) {
      // 認証が成功
      // セッションIDの追跡を防ぐ
      session_regenerate_id(true);
      //ユーザ名をセット
      $_SESSION['username'] = $n;
      // ログイン後に/に遷移
      header ('Location: ./home_tab.php');
      exit;
		}
	}
}
?>

<!DOCTYPE html>
<html lang='ja'>
  
  <head>
           <title>上島Pay</title>
  </head>
  <body>
    
           
             <center><h3>ログイン</h3></center>

             <center>
                <form action='login.php' method='POST'>
                          <p>ユーザID：<input type='text' name='userid'></p>
                          <p>パスワード：<input type='password' name='pass'></p>
                          <input type='submit' value='ログイン' class="button"></a>
               </form>
      </center>
   
  </body>
</html>