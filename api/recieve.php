<?php

function get_request() {
    $content_type = explode(';', trim(strtolower($_SERVER['CONTENT_TYPE'])));
    $media_type = $content_type[0];

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $media_type == 'application/json') {
        // application/json で送信されてきた場合の処理
        $request = json_decode(file_get_contents('php://input'), true);
    } else {
        // application/x-www-form-urlencoded で送信されてきた場合の処理
        // REQUESTのjsonが多層の時はうまく行かない
        $request = $_REQUEST;

        // REQUESTのjsonが多層の場合に対応
        foreach ($_REQUEST as $key => $value) {
            $request[$key] = json_decode($value, true);

            // json_decodeはクォートされていない文字列がnullになるので戻す
            if ($request[$key] == null) {
                $request[$key] = $value;
            }
        }
    }

    return $request;
}

// main
$data = get_request();
// print_r($data);
if($data === null){
    return;
}else{
    // My SQL データベースの接続
    define('DB_DATABASE','kpay');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','tabusalab11!');
    define('PDO_DSN','mysql:dbhost=52.156.45.138;dbname=kpay');

    try{
        $dbh=new PDO(PDO_DSN , DB_USERNAME , DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $dbh->query('SET NAMES utf8'); //文字化けの解消

        $userID = $data["userID"];
        $shopID = $data["shopID"];
        $productID = $data["productID"];
        $date = date('Y-m-d H:i:s');

        $query = "INSERT INTO history_tab(userid,shopid,productid,datetime) VALUES('$userID','$shopID','$productID','$date')";
        $stmt = $dbh->query($query);
        
    }catch(PDOException $e){
        echo $e->getMessage();
        exit();
    }
    



}
$dbh = null;