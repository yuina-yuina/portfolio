<?php
session_start();
$_SESSION['insert'] = true;

//  PC
const DB_HOST = 'localhost';
const DB_NAME = 'webpro';
const DB_USER = 'root';
const DB_PASSWORD = '';
const T_NAME = 'k1718076';	//*******部分を学籍番号に変更

//データベース接続
try {
	$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASSWORD );
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
	die('エラーメッセージ：'.$e->getMessage());
}


//$stt = $db->prepare('INSERT INTO k1718076(date, cat, title, text, img) VALUES(:date, :cat, :title, :text, :img)');
//$stt->bindValue(':title', $_POST['title']);	//htmlspecialcharsを兼ねる
//$stt->bindValue(':date', $_POST['date']);

?>


<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css">
	<title>今日の日記</title>
</head>

<body class="todo">

<h1></h1>

<div><a href="kadai.php">日記一覧</a></div>
<form method="post" action="kadai.php" enctype="multipart/form-data" class="a">
<label>日付　　　<input type="text" name="date" size="10" maxlength="10"></label><br>
<label>気分検索　
	<select name="cat">
		<option value="">指定なし</option>
		<option value="悲しい">悲しい</option>
		<option value="嬉しい">嬉しい</option>
		<option value="幸せ">幸せ</option>
		<option value="怒り">怒り</option>
	</select>
</label><br>
<label>タイトル　<input type="text" name="title" size="30" maxlength="30"></label><br>
<label>日記　　　<input type="text" name="text" size="100" maxlength="200"></label><br>
<label>画像　　　<input type="hidden" name="img" value="1000000">
			<input type="file" name="imgfile" size="10">
</label><br><br>


<form  method="post" action="kadai.php"onsubmit="return confirmSubmit()">
	<input type="hidden" name="new">
	<input type="submit" value="登録">
</form>
<form  method="post" action="new.php">
	<input type="reset" value="リセット">
</form>

</body>
</html>