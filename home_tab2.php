<?php

require_once __DIR__ . '/functions.php';
require_logined_session();

header ('Content-Type: text/html; charset=UTF-8');

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

	<h1>ようこそ、<?=h($_SESSION["username"])?>さん！</h1>



<p><a href="./logout.php?token=<?=h(generate_token())?>">ログアウト</a></p>
</center>
</body>
</html>
