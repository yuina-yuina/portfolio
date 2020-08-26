<?php
    function h($str){
    return htmlspecialchars($str,ENT_QUOTES,'utf-8');
    }

    $name = $_POST['name'];
    $message = $_POST['message'];

    $success = true;

    if(mb_strlen($name,'utf-8') > 20){
        $name_error = '※20文字以内で入力してください。';
        $success = false;
    }
    if(empty($name)){
        $name_error = '※お名前を入力してください。';
        $success = false;
    }
    if(mb_strlen($message,'utf-8') > 200){
        $message_error = '※200文字以内で入力してください。';
        $success = false;
    }
    if(empty($message)){
        $message_error = '※つぶやきを入力してください。';
        $success = false;
    }

    session_start();
    $_SESSION['name']= $_POST['name'];
    $_SESSION['message']= $_POST['message'];
    $_SESSION['success']= $success;

    $_SESSION['name_error'] = $name_error;
    $_SESSION['message_error'] = $message_error;

    if(!$success){
        header('Location:index.php');
        exit;
    }

    if($success){
        require_once('post.php');
    }
?>