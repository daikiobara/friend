<?php

$area_id = $_GET['id'];

if(isset($_POST['name'])){

echo'おらら〜';

		$dsn = 'mysql:dbname=camptest;host=localhost';
		$user = 'root';
		$password = 'camp2014';
		$dbh = new PDO($dsn,$user,$password);
		$dbh->query('SET NAMES utf8');

$sql = 'INSERT INTO camptest.Friend_table (id,area_table_id,name,gender,age) VALUES (NULL,"'.$_GET['id'].'", "'.$_POST['name'].'","'.$_POST['gender'].'","'.$_POST['age'].'")';

echo $sql;

		$stmt = $dbh->prepare($sql);
    	$stmt->execute();


    	$dsn = null;

    	header('location:friendsd.php?id='.$_GET['id'].'&return=1');
			exit();

}






?>








<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>PHP基礎</title>
</head>
<body>



	<form method="post" action="addd.php?id=<?php echo $area_id;?>">
		名前<input name ="name" type="text" style="width:100px"><br />
		年齢<input name ="age" type="text" style="width:100px"><br />
		性別<input name ="gender" type="text" style="width:100px"><br />
		<br />
  		<FORM ACTION=" " METHOD="POST">
    		<SELECT NAME="name5">
        		<option VALUE="1">男
        		<option VALUE="2">女
    		</SELECT>
    	<INPUT TYPE="submit" VALUE="送る">
    	<INPUT TYPE="reset" VALUE="取消">
	</FORM>
<input type="submit" value="送信">
</form>



</body>
</html>