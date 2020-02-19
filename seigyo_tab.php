<!DOCTYPE html>
<html lang = "ja">

<head>
	<title></title>
</head>


<body>


<?php
if (isset($_POST['tya-ji'])) {
        //チャージボタンの時の処理
?>
    <input type="hidden" name="uid" value="<?php echo $userid; ?>">
    <input type="hidden" name="uname" value="<?php echo $username; ?>">
<?php
        header('Location:  http://52.156.45.138/~db2019/kamijimapay/tya-ji.php');
        exit;

}elseif ( isset($_POST['rireki']) ){
        //履歴ボタンの時の処理
?>
        <input type="hidden" name="uid" value="<?php echo $userid; ?>">
        <input type="hidden" name="uname" value="<?php echo $username; ?>">
<?php
        header('Location:  http://52.156.45.138/~db2019/kamijimapay/rireki.php');
        exit;

}

 ?>