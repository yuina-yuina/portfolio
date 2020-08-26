<?php

/******************************
画像アップロード処理関数
	INPUT
		$filename	アップロード対象ファイルのname属性	
			<input type="file" name="imgfile"  />	-> 'imgfile'
		$path	アップロード先のディレクトリ名	
			実行プログラムディレクトリ内
			省略時は実行プログラムディレクトリ直下に保存
	OUTPUT
		return	アップロード画像のURL
******************************/
function uploadimagefile( $filename,$path='' ){
	$ext = pathinfo($_FILES[$filename]['name'], PATHINFO_EXTENSION);
	$perm = array('gif', 'jpg', 'jpeg', 'png');

	if ( $_FILES[$filename]['error'] !== UPLOAD_ERR_OK ) {
		$msg = array(
			UPLOAD_ERR_INI_SIZE => 'php.iniのupload_max_filesize制限を越えています。',
			UPLOAD_ERR_FORM_SIZE => 'HTMLのMAX_FILE_SIZE 制限を越えています。',
			UPLOAD_ERR_PARTIAL => 'ファイルが一部しかアップロードされていません。',
			UPLOAD_ERR_NO_FILE => 'ファイルはアップロードされませんでした。',
			UPLOAD_ERR_NO_TMP_DIR => '一時保存フォルダが存在しません。',
			UPLOAD_ERR_CANT_WRITE => 'ディスクへの書き込みに失敗しました。',
			UPLOAD_ERR_EXTENSION => '拡張モジュールによってアップロードが中断されました。'
		);
		$err_msg = $msg[$_FILES[$filename]['error']];

	}elseif( !in_array(strtolower($ext), $perm) ) {
		$err_msg = '画像以外のファイルはアップロードできません。';

	}elseif( !@getimagesize($_FILES[$filename]['tmp_name']) ) {
		$err_msg = 'ファイルの内容が画像ではありません。';

	}else{
		$src = $_FILES[$filename]['tmp_name'];
		$imgpath = $path.$_FILES[$filename]['name'];
		if(!move_uploaded_file($src, $imgpath)) {
			$err_msg = 'アップロード処理に失敗しました。';
		}
	}

	if ( isset($err_msg) ) {
		die('<div>'.$err_msg.'</div>');
	}
	return ( empty($_SERVER['HTTPS']) ? 'http://' : 'https://' ) . pathinfo($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],PATHINFO_DIRNAME ) . '/' . $imgpath;

}

?>
