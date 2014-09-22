<?php

$area_id = $_GET['id'];

if(isset($_POST['name'])){

echo'うんち';

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



	<form method="post" action="addd.php?id=<?php echo $unchi;?>">
	名前<br/>
		<input name ="name" type="text" style="width:100px; height:30px;"maxlength="20"><br />
		性別<br />
		<input name ="gender" type="text" style="width:200px; height:30px;"maxlength="10"><br />
		年齢<br />

		<input name ="age" type="text" style="width:300px; height:30px;"maxlength="10"><br />

		<input type="submit" value="送信">

	</form>

</body>
</html>