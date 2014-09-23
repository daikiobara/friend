
<?php

if(isset($_GET['return'])){
			$return = $_GET['return'];
	echo '友達が一人追加されました。<br/>';


		}else{
			$return = 0;
		}


	$dsn= 'mysql:dbname=camptest;host=localhost';
	$user ='root';
	$password ='camp2014';
	$dbh =new PDO($dsn, $user, $password);
	$dbh ->query('SET NAMES utf8');

	$sql = 'SELECT * FROM area_table WHERE id ='.$_GET['id'].';';
	//area_tableでidが$GETidと同じ物のnameを引き出す。
	$stmt = $dbh->prepare($sql);
    $stmt->execute();
	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
   

    echo $rec['name'].'<br/>';


   $sql = 'SELECT * FROM `Friend_table` WHERE area_table_id = '.$_GET['id'];

    $stmt= $dbh->prepare($sql);
    $stmt->execute();


    echo '<ul>';
		while(1){
			$rec = $stmt->fetch(PDO::FETCH_ASSOC);
				if ($rec == false){
				break;
				}
				echo '<li>'.$rec['name'].'<form method="post" action="editd.php?id='.$rec['id'].'"><input type="submit" value="編集"></form></li>';
				}
				$dsn = null;
				//データーベースと切断
	echo '</ul>';

?>

<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>PHP基礎</title>
</head>
<body>

	<form method="post" action="addd.php?id=<?php echo $_GET['id']; ?>">
		<input type="hidden" name="area_table_id" value="<?php echo $area_id; ?>" >
		<input type="submit" value="追加">
	</form>


</body>
</html>
