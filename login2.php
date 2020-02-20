<?php

require_once __DIR__ . '/functions.php';
require_unlogined_session();

foreach (['username','password','token','submit'] as $key) {
    $$key = (string)filter_input(INPUT_POST, $key);
}

// エラーを格納する配列を初期化
$errors = [];

// POSTのときのみ実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ( $username === "" || $password ==="" ) {
        $errors[] = 'ユーザ名またはパスワードが入力されていません。';
    } else {

        $username = h($username);
        $password = h($password);
        print_r($username);
        print_r($password);

        // My SQL データベースの接続
        define('DB_USERNAME','root');
        define('DB_PASSWORD','tabusalab11!');

        $dbtype  = 'mysql';
        $host    = '52.156.45.138';
        $db      = 'kpay';
        $charset = 'utf8';

        try{
            $dsn = "$dbtype:host=$host; dbname=$db; charset=$charset";
            $db = new PDO ( $dsn, DB_USERNAME, DB_PASSWORD );
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = 'SELECT * FROM user_tab WHERE userid = ?';
            $prepare = $db->prepare($sql);
            $prepare->bindValue(1, $username, PDO::PARAM_INT);
            $prepare->execute();

            $result = $prepare->fetch(PDO::FETCH_ASSOC);
            print_r(result);
        }catch(PDOException $e){
            echo $e->getMessage();
            exit();
        }

        if (validate_token(filter_input(INPUT_POST, 'token')) && password_verify( $password, $result["password"] )) {
            // 認証が成功
            // セッションIDの追跡を防ぐ
            session_regenerate_id(true);
            //ユーザ名をセット
            $_SESSION['username'] = $username;
            // ログイン後に/に遷移
            header ('Location: ./home_tab2.php');
            exit;
            }
        // 認証が失敗
        $errors[] = "ユーザ名またはパスワードが違います";
    }
}
header ('Content-Type: text/html; charset=UTF-8');
?>

<!DOCTYPE html>
<html>
<head>
<title>ログインページ</title>
</head>
<body>
<h1>ログインしてください</h1>
<?php if ($errors): ?>
<ul>
    <?php foreach ($errors as $err): ?>
    <li><?=h($err)?></li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
<form method="post" action="">
    <p>ユーザ名: <input type="text" name="username" value="<?php echo $username = isset($_POST['username']) ? $_POST['username']: ''; ?>"></p>
    <p>パスワード: <input type="password" name="password" value=""></p>
    <!-- トークン -->
    <input type="hidden" name="token" value="<?=h(generate_token())?>">    <!--<input type="hidden" name="token" value="<?php echo password_hash('1111', PASSWORD_DEFAULT, array('cost', 10)) ?>">-->
    <p><input type="submit" name="submit" value="ログイン"></p>
</form>
</body>
</html>