<?php
  define('DB_DATABASE','kpay');
  define('DB_USERNAME','root');
  define('DB_PASSWORD','tabusalab11!');
  define('PDO_DSN','mysql:dbhost=kpay@52.156.45.138;dbname=kpay');

  try{
    $dbh=new PDO(PDO_DSN , DB_USERNAME , DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $dbh->query('SET NAMES utf8');
  }catch(PDOException $e){
    echo $e->getMessage();
    exit();
  }

  $userid = $_POST['userid'];
  $pass = $_POST['pass'];

  $query = "select * from user_tab";
  $stmt = $dbh->query($query);
  $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);


 foreach ($rec as $row) {
   $userid = $abc['userid'];
   $username = $abc['username'];
   $pass = $abc['pass'];
   
   if ($userid == $userid && $pass == $pass) { ?>
     <!DOCTYPE html>
     <html lang='ja'>
      
     <head>
       <title>上島Pay</title>
     </head>
     <body>
      
           <center>
                        <form action="home_tab.php" method="POST">
              <input type='hidden' name='uid' value=<?php echo $userid ?>>
              <input type='hidden' name='uname' value="<?php echo $username ?>">
                                  </form>
             </center>
   
     </body>
     </html>
  <?php
    $cnt=1;
    break;
  }
}if($cnt!=1){
?>
  <!DOCTYPE html>
  <html lang='ja'>
   
  <head>
        <title>ログイン失敗</title>
  </head>

  <body>
  
       
          <center><h3>ログイン失敗</h3></center>

    <center>
                <form action="login.php" method="POST">
                    <input type='submit' value='ログイン画面' class ="button"></p>
                </form>
        </center>
    
  </body>
  </html>
<?php } ?>