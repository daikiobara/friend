<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>PHP基礎</title>
</head>
<body>
<?php

	$dsn= 'mysql:dbname=camptest;host=localhost';
	$user ='root';
	$password ='camp2014';
	$dbh =new PDO($dsn, $user, $password);
	$dbh ->query('SET NAMES utf8');

	$sql = 'select * from area_table order by id;';

	$stmt = $dbh->prepare($sql);
	$stmt->execute();

echo '<ul>';
	while(1){

	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($rec == false){
			break;
	}
		
	echo '<li><a href="friendsd.php?id='.$rec['id'].'">'.$rec['name'].'</a></li>';
	


		}


echo '</ul>';

$dbh = null;



?>

</body>

</html>