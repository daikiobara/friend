<?php

	$friend_id = $_GET['id'];

		$dsn = 'mysql:dbname=camptest;host=localhost';
		$user = 'root';
		$password = 'camp2014';
		$dbh = new PDO($dsn,$user,$password);
		$dbh->query('SET NAMES utf8');

if(isset($_POST['name'])){
			
	echo '変更されました。<br/>';
$sql = 'UPDATE `camptest`.`Friend_table` SET `area_table_id` ='.$_POST['area_table_id'].', `name` = '.$_POST['name'].', `gender` = '.$_POST['gender'].', `age` = '.$_POST['age'].'WHERE `Friend_table`.`id` = '.$friend_id.';';
//$sql = 'UPDATE camptest.Friend_table (id,area_table_id,name,gender,age) VALUES (NULL,"'.$_GET['id'].'", "'.$_POST['name'].'","'.$_POST['gender'].'","'.$_POST['age'].'")';
				$stmt = $dbh->prepare($sql_for_friend);
				$stmt->execute();	
				$rec_update = $stmt->fetch(PDO::FETCH_ASSOC);
				echo $sql.'<br/>';
		}

//$sql = 'UPDATE `camptest`.`Friend_table` SET `area_table_id` ='.$area_table_id.', `name` = '.$name.', `gender` = '.$gender.', `age` = '.$age.' WHERE `Friend_table`.`id` = '.$friend_id;
//$sql = 'UPDATE camptest.Friend_table (id,area_table_id,name,gender,age) VALUES (NULL,"'.$_GET['id'].'", "'.$_POST['name'].'","'.$_POST['gender'].'","'.$_POST['age'].'")';
				//$stmt = $dbh->prepare($sql_for_friend);
				//$stmt->execute();	

		$sql_for_friend = 'select * from Friend_table where id ='.$friend_id;

			$stmt = $dbh->prepare($sql_for_friend);
				$stmt->execute();
					$rec_for_friend = $stmt->fetch(PDO::FETCH_ASSOC);

	var_dump($rec_for_friend);
		$area_id = $rec_for_friend['area_table_id'];
		$sql = 'select name from area_table where id ='.$area_id.';';
			$stmt = $dbh->prepare($sql);
				$stmt->execute();
					$rec = $stmt->fetch(PDO::FETCH_ASSOC);
						$area_name = $rec['name'];

		$sql_for_area = 'select * from area_table order by id;';

		$stmt = $dbh->prepare($sql_for_area);
		$stmt->execute();

	while(1){

			$rec_area = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($rec_area == false){
				break;
			}

			$area[] = $rec_area;
		}

		if (isset($_POST['name'])){
		 	//保存ボタンが押された時
		

		 	$name = $_POST['name'];
		 	$gender = $_POST['gender'];
		 	$age = $_POST['age'];
		 	$area_table_id = $_POST['area_table_id'];

		 	if (!is_numeric($age)){
		 		//数値ではない時
		 		echo '年齢は数値を入れて下さい';
		 	}


		 	}
		 	$dsn = null;

?>


<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>PHP基礎</title>
</head>
<body>

<form method="POST" action="editd.php?friend_id=<?php echo $friend_id; ?>">
		名前:<input type="text" name="name" style="width:150px;" value="<?php echo $rec_for_friend['name']; ?>"><br />
		年齢:<input type="text" name="age" style="width:150px;" value="<?php echo $rec_for_friend['age']; ?>"><br />
		性別:<select name="gender">
				<option value="男" <?php if($rec_for_friend['gender']=='男'){echo 'selected';} ?> >男性</option>
				<option value="女" <?php if($rec_for_friend['gender']=='女'){echo 'selected';} ?> >女性</option>
			</select><br />
		都道府県:<select name="area_table_id">
					<?php 
						foreach ($area as $area_each) {
							$selected = '';
							if ($area_each['id'] == $area_id){
								$selected = 'selected';
							}

							echo '<option value="'.$area_each['id'].'" '.$selected.' >'.$area_each['name'].'</option>';
						}

					?>
				</select>
			<!-- <input type="hidden" name="area_table_id" value="<?php // echo $area_id; ?>" > -->
		<br />
		<input type="submit" value="保存" onclick="return confirm('本当に変更しますか？');" 		>
	</form>









</body>
</html>