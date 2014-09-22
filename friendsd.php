
<?php

if(isset($_GET['return'])){
			$return = $_GET['return'];
	echo '友達が一人追加されました。<br/>';


		}else{

			$return = 0;

		}



?>



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

	$sql = 'SELECT * FROM area_table WHERE id = '.$_GET['id'];
	//area_tableでidが$GETidと同じ物のnameを引き出す。
	$stmt = $dbh->prepare($sql);
    $stmt->execute();
	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
   

    echo $rec['name'].'<br/>';

    $sql = 'SELECT name FROM `Friend_table` WHERE area_table_id = '.$_GET['id'];

    $stmt_for_name = $dbh->prepare($sql);
    $stmt_for_name->execute();

    echo '<ul>';
		while(1){
			$rec_for_name = $stmt_for_name->fetch(PDO::FETCH_ASSOC);
				if ($rec_for_name == false){
				break;
				}
				echo '<li>'.$rec_for_name['name'].'</li>';
			}

	echo '</ul>';
?>
	<form method="post" action="addd.php?id=<?php echo $_GET['id'];?>">
	<input type="submit" value="追加">

	</form>







</body>
</html>
