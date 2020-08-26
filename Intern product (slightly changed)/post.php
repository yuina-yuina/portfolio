<?php
    session_start();
    date_default_timezone_set('Asia/Tokyo');

    const DB_HOST = 'localhost';
    const DB_NAME = 'intern';
    const DB_USER = 'root';
    const DB_PASSWORD = 'root';
    const T_NAME = 'board';

    try {
        $db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASSWORD );
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        die('現在、つぶやきを取得できません。');
    }
    $sql = "INSERT INTO board(post_name, message, create_at, update_at) VALUES (?, ?, ?, ?)";
    $stmh = $db->prepare($sql);
    $stmh->bindValue(1, $_POST["name"]);
    $stmh->bindValue(2, $_POST["message"]);
    $stmh->bindValue(3, date('Y-m-d H:i:s'));
    $stmh->bindValue(4, date('Y-m-d H:i:s'));

    try {
        $stmh->execute();
        $result = 0;
        $alert = "<div id='modal-content' class='ok'>
                    <p class='text'>つぶやきました！</p>
                    <p class='close'><a id='modal-close' class='button-link' onclick='modal_onclick_close()' ><span></span></a></p>
                </div>";
        $_SESSION['status'] = $alert;
    }catch(PDOException $e){
        $result = $e->getCode();
        $alert = "<div id='modal-content ng'>
                    <p class='text'>つぶやきに失敗しました。</p>
                    <p class='close'><a id='modal-close' class='button-link' onclick='modal_onclick_close()' ><span></span></a></a></p>
                </div>";
        $_SESSION['status'] = $alert;
    }
    $db = null;

    header('Location: index.php');
?>