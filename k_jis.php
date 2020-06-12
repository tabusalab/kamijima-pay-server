<?php

// My SQL データベースの接続
define('DB_DATABASE','tabusalab');
define('DB_USERNAME','root');
define('DB_PASSWORD','tabusalab');
define('PDO_DSN','mysql:dbhost=52.156.45.138;dbname=tabusalab');

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
	<center>
	<font size="5">
		<h1>出席管理</h1>
	</font>

	<!-- 使える店舗一覧 -->

	<br>

	<table border="1" >
	<tr><th>実習id</th><th>実習名</th><th>実習時間</th><th>実習場所</th><th>担当者</th></tr>
	
	<?php
		$query="select * from Pra_tabuken";
		$stmt = $dbh->query($query);
		$rec = $stmt->fetchAll(PDO::FETCH_ASSOC);

		foreach($rec as $row ){
			$praid=$row['praid'];
			$praname=$row['praname'];
			$pratime=$row['pratime'];
			$praplace=$row['praplace'];
			$prauser=$row['prauser'];

			echo "<tr><td>$praid</td>";
			echo "<td>$praname</td>";
			echo "<td>$pratime</td>";
			echo "<td>$praplace</td>";
			echo "<td>$prauser</td></tr>";
		}

	?>
	

     </table>
     </center>
</body>
</html>

