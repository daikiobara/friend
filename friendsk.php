<!DOCTYPE html>
<html class="no-js" lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title>sample</title>
<!-- <link rel="stylesheet" href="../html/css/normalize.css"> -->
<!-- <link rel="stylesheet" href="../html/css/style.css">  -->
</head>
<body>

<?php

	// echo 'idは'.$_GET['id'];
	$area_id = $_GET['id'];


  //接続オブジェクトを作成する
	$dsn = 'mysql:dbname=CampTest;host=localhost';
	$user = 'root';
	$password ='camp2014';
	$dbh = new PDO($dsn,$user,$password);
	$dbh->query('SET NAMES utf8');


	$sql = 'SELECT name FROM `area_table` WHERE id = '.$_GET['id'];
	//SQL文　area_tableからnameデータを取得する。
	$stmt_name = $dbh->prepare($sql);
	//SQLの準備　定型文　$stmtへ代入イメージ
	$stmt_name->execute();
	//SQLの準備　定型文

	
	$sql = 'SELECT * FROM `friend_table` WHERE area_table_id = '.$_GET['id'];
	//SQL friend_tableから　area_table_id = (変数)のデータを取得
	$stmt_friend = $dbh->prepare($sql);
	//SQL定型文
	$stmt_friend->execute();


	$sql = 'SELECT count(*) `id`,`gender` FROM (SELECT * FROM `friend_table` WHERE `area_table_id`='.$_GET['id'].') as `friend_table` group by `gender`';
	$stmt_count_gender = $dbh->prepare($sql);
	$stmt_count_gender->execute();


	$rec_name = $stmt_name->fetch(PDO::FETCH_ASSOC);
	//fetch サーバーからデータを取り出す。（１行）
	

	echo '<h1>'.$rec_name['name'].'の友達リスト'.'</h1>';

	$count =0;
	while ($count < 2) {
		$rec_count_gender = $stmt_count_gender->fetch(PDO::FETCH_ASSOC);

		if($count == 1){
			echo '男性:'.$rec_count_gender['id'].'人  ';
		}
		if($count == 0){
			echo '女性:'.$rec_count_gender['id'].'人  ';
		}
		if($rec_count_gender ==false)
		{
			break;
		}
		$count ++;
		//echo $rec_count_gender['id'];
	}



    echo '<ul>';

    // //一度配列に落として、扱い易くする。「先生回答」
    // //配列の初期設定
    // $friends = array();//配列の初期化
    // while($rec){
    // 	$rec = $stmt->fetch(PDD::FETCH_ASSOC);
    // 	//$recへ挿入.fetchを使うとカーソルが下がる。whileを使っているからではない。
    // 	$friends[] = $rec;
    // }


    while(1){
    	$rec_friend = $stmt_friend->fetch(PDO::FETCH_ASSOC);
    	if($rec_friend == false)
    	{ //データの終わりにカーソルが移動した時に無限ループを抜ける
    		break;
    	}
    	echo '<li>'.$rec_friend['name'].'</li>';

    }
	$dbh =null;
    


?>

<form method="POST" action="add.php?id=<?php echo $area_id;?>">
<!-- //データの受け渡し add.phpへidの変数を転送 -->
	<input type="submit" value="追加">	
</form>


</body>
</html>