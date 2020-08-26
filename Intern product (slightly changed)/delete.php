<?php
    session_start();

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

    $sql = "DELETE FROM board WHERE id = ?";
    $stmh = $db->prepare($sql);
    $stmh->bindValue(1, $_POST["delid"]);
    
    try {
        $stmh->execute();
        $result = 0;
    }catch(PDOException $e){
        $result = $e->getCode();
    }

    $db = null;
    header('Location: index.php');
?>