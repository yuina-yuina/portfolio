<?php
	require_once 'functions.php';
	session_start();


	//	PC
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
	
	
//レコード追加
	if( isset($_POST['new']) ){
		$imgpath = '';
		if( isset( $_FILES['imgfile']['name'] ) && $_FILES['imgfile']['name'] != '' ){
			$imgpath = uploadimagefile( 'imgfile','img/' );
		}
		try {
			$stt = $db->prepare('INSERT INTO k1718076(date, cat, title, text, img) VALUES(:date, :cat, :title, :text, :img)');//テーブル名を各自の設定に応じて変更
			$stt->bindValue(':date', $_POST['date']);
			$stt->bindValue(':cat', $_POST['cat']);
			$stt->bindValue(':title', $_POST['title']);
			$stt->bindValue(':text', $_POST['text']);
			$stt->bindValue(':img', $imgpath);
			$stt->execute();
		}catch(PDOException $e){
			die('エラーメッセージ：'.$e->getMessage());
		}
	unset( $_SESSION['insert'] );
	}
	
	
//レコード抽出
	try {
		$sqlstr = 'SELECT * FROM '.T_NAME;
		$sqlwhere = '';
		//	カテゴリー指定あり
		if( isset($_POST['querycat']) && $_POST['querycat']!="" ){
			if( $sqlwhere == '' ){
				$sqlwhere = ' WHERE cat = "'.$_POST['querycat'].'"';
			}else{
				$sqlwhere .= ' AND cat = "'.$_POST['querycat'].'"';
			}
		}
		if( $sqlwhere != '' )	$sqlstr .= $sqlwhere;
		//	ソート指定あり
		if( isset($_POST['queryorder']) && $_POST['queryorder']!="" ){
			$sqlstr .= ' ORDER BY '.$_POST['queryorder'];
		}
		$stt = $db->prepare($sqlstr);
		$stt->execute();
	} catch(PDOException $e) {
		die('エラーメッセージ：'.$e->getMessage());
	}
	
	

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css">
	<title>Webpro課題</title>
<script>
function confirmSubmit() {	return confirm ( "削除してもよろしいですか？");}
</script>
</head>

<body class="todo">
<h1>Webpro課題</h1>

<?php
//更新・削除結果の表示
if ( isset( $_SESSION['status'] ) ) {
	echo $_SESSION['status'] . '<br><hr>';
	unset( $_SESSION['status'] );
}
?>


<div><a href="new.php">新規登録</a></div>

<form method="post" class="a">
<h2>検索/ソート</h2>
<label>気分検索　
	<select name="querycat">
		<option value="">指定なし</option>
		<option value="悲しい" <?php if(isset($_POST['querycat']) && $_POST['querycat'] == '悲しい'){echo 'selected';}?>>悲しい</option>
		<option value="嬉しい" <?php if(isset($_POST['querycat']) && $_POST['querycat'] == '嬉しい'){echo 'selected';}?>>嬉しい</option>
		<option value="幸せ" <?php if(isset($_POST['querycat']) && $_POST['querycat'] == '幸せ'){echo 'selected';}?>>幸せ</option>
		<option value="怒り" <?php if(isset($_POST['querycat']) && $_POST['querycat'] == '怒り'){echo 'selected';}?>>怒り</option>
	</select>
</label>
<br>
<input type="submit" value="検索">
<br>
<label>ソート　
	<select name="queryorder">
		<option value="">指定なし</option>
		<option value="date">日付　昇順</option>
		<option value="date DESC">日付　降順</option>
	</select>
</label>
<br>
<input type="submit" value="実行">

<h2>一覧</h2>
<div>SQL:[<?php echo $sqlstr ?>]</div>
<table border>
<tr><th>ID<th>日付<th>気分<th>タイトル<th>日記<th>画像<th>作成日時<th>更新<th>削除
<?php while ($row = $stt->fetch()) { ?>
<tr>
<td><?php echo $row['id'];?>
<td><input type="date" name="date" size="10" value=<?php echo $row['date'];?>>
<td><select name="cat">
		<option value="悲しい" <?php if($row['cat'] == '悲しい'){echo 'selected';}?>>悲しい</option>
		<option value="嬉しい" <?php if($row['cat'] == '嬉しい'){echo 'selected';}?>>嬉しい</option>
		<option value="幸せ" <?php if($row['cat'] == '幸せ'){echo 'selected';}?>>幸せ</option>
		<option value="怒り" <?php if($row['cat'] == '怒り'){echo 'selected';}?>>怒り</option>
	</select>
<td><input type="text" name="title" size="10" maxlength="20" value=<?php echo $row['title'];?>>
<td><input type="text" name="text" size="50" maxlength="200" value=<?php echo $row['text'];?>>
<td><?php if($row['img']!=""){echo '<img src="'.$row['img'].'" width=150>';}?><br>
	<input type="hidden" name="img" value="1000000">
	<input type="file" name="imgfile" size="10">
<td><?php echo $row['cdate'];?>
<td>
<form method="post" action="update.php" enctype="return confirmSubmit()">
	<input type="hidden" name="editid" value=<?php echo $row['id'];?> <?php echo $row['date'];?> <?php echo $row['cat'];?> <?php echo $row['title'];?> <?php echo $row['text'];?> <?php echo $row['img'];?>>
	<input type="submit" value="更新">
</form>
<td>
<form  method="post" action="delete.php"onsubmit="return confirmSubmit()">
	<input type="hidden" name="delid" value=<?php echo $row['id'];?>>
	<input type="submit" value="削除">
</form>

  
<?php } ?>
</table>
</body>
</html>
