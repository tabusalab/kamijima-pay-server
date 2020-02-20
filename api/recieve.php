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

        if($data["price"]==null){

            
            $queryprice="SELECT * FROM product_tab WHERE productid=$productID";
            $stmt2 = $dbh->query($queryprice);
            $rec = $stmt2->fetchAll(PDO::FETCH_ASSOC);
            foreach($rec as $row){
                $price=$row['product_price'];
            } 
        }else{

            $price = $data["price"];
        }
        
        $querybalance = "UPDATE money_tab SET balance=balance-$price WHERE userid=$userID";
        $stmt1 = $dbh->query($querybalance);
        $queryreadbal = "SELECT * FROM money_tab WHERE userid=$userID";
        $stmtb = $dbh->query($queryreadbal);
        $recbal = $stmtb->fetchAll(PDO::FETCH_ASSOC);
        foreach($recbal as $rowbal){
            $balance=$rowbal["balance"];
        }
        if($data["price"]==null){
            $query = "INSERT INTO history_tab(userid,shopid,productid,balance,datetime) VALUES('$userID','$shopID','$productID',$balance,'$date')";
        }else{
            $query = "INSERT INTO history_tab(userid,shopid,productid,price,balance,datetime) VALUES('$userID','$shopID','$productID','$price',$balance,'$date')";

        }
        $stmt = $dbh->query($query);
        echo json_encode("success");
        
    }catch(PDOException $e){
        echo $e->getMessage();
        exit();
    }
    



}
$dbh = null;