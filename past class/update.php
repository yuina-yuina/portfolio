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

//レコード更新
	if( isset($_POST['editid']) ){
		try {
			//画像更新あり
			if( isset( $_FILES['imgfile']['name'] ) && $_FILES['imgfile']['name'] != '' ){//画像更新時
				//アップロード処理
				$imgpath = uploadimagefile( 'imgfile','img/' );
	
				$stt = $db->prepare('UPDATE ' . T_NAME . ' SET date=:date, cat=:cat, title=:title, text=:text, img=:img WHERE id=:id' );//テーブル名や項目を各自の設定に応じて変更
				$stt->bindValue(':img', $imgpath);
	
			}else{		//	画像更新なし
				$stt = $db->prepare('UPDATE ' . T_NAME . ' SET date=:date, cat=:cat, title=:title, text=:text WHERE id=:id' );//テーブル名や項目を各自の設定に応じて変更
			}
			$stt->bindValue(':date', $_POST['date']);
			$stt->bindValue(':cat', $_POST['cat']);
			$stt->bindValue(':title', $_POST['title']);
			$stt->bindValue(':text', $_POST['text']);
			$stt->bindValue(':id', $_POST['editid']);
			$stt->execute();
		}catch(PDOException $e){
			die('エラーメッセージ：'.$e->getMessage());
		}
	}

//echo "done=" . $_POST['done'];
//echo "id=" . $_POST['editid'];


//$_SESSION['status'] = '保存しました。';

//header('Location: '. ( empty($_SERVER['HTTPS']) ? 'http://' : 'https://' ) .$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/kadai.php');?>
