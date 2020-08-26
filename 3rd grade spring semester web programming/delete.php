<?php
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

//レコード削除
if( isset($_POST['delid']) ){
	try {
		$stt = $db->prepare('DELETE FROM k1718076 WHERE id = :id' );//テーブル名を各自の設定に応じて変更
		$stt->bindValue(':id', $_POST['delid']);
		$stt->execute();
	}catch(PDOException $e){
		die('エラーメッセージ：'.$e->getMessage());
	}
}



$_SESSION['status'] = '削除しました。';

//echo "id=" . $_POST['delid'];

header('Location: '. ( empty($_SERVER['HTTPS']) ? 'http://' : 'https://' ) .$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/kadai.php');?>
