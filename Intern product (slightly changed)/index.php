<?php
    session_start();

    function h($str){
        return htmlspecialchars($str,ENT_QUOTES,'utf-8');
    }

    session_start();

    $name = '';
    $message = '';
    $name_error= '';
    $message_error= '';

    if(isset($_SESSION['name'])){
        $name = $_SESSION['name'];
    }
    if(isset($_SESSION['message'])){
        $message = $_SESSION['message'];
    }
    if(isset($_SESSION['name_error'])){
        $name_error = $_SESSION['name_error'];
        unset( $_SESSION['name_error'] );
    }
    if(isset($_SESSION['message_error'])){
        $message_error = $_SESSION['message_error'];
        unset( $_SESSION['message_error'] );
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <title>みんなのつぶやき</title>
        <script type="text/javascript">
            function modal_onclick_close(){
                document.getElementById("modal-content").style.display = "none";
                document.getElementById("modal-overlay").style.display = "none";
            }
        </script>
    </head>

    <body>
        <?php
            //投稿しましたの表示
            if ( isset( $_SESSION['status'] ) ) {
                echo $_SESSION['status'] . '<br>';
                unset( $_SESSION['status'] );
            }
        ?>
        <h2>みんなのつぶやき</h2>
        <form  method="post" action="error.php">
            <div class="sub">
                <label>お名前</label>&ensp;
                <?php if(mb_strlen($name,'utf-8')>20){echo "<span class='red'>{$name_error}</span>";} ?>
                <?php if(empty($name)){echo "<span class='red'>{$name_error}</span>";} ?>
                <br>
                <input type="text" name="name" class="name" size="15"><br><br>
                <label>つぶやき</label>&ensp;
                <?php if(mb_strlen($message,'utf-8')>140){echo "<span class='red'>{$message_error}</span>";}?>
                <?php if(empty($message)){echo "<span class='red'>{$message_error}</span>";} ?>
                <br>
                <textarea name="message" class="message" rows="4"></textarea><br><br>
                <input type="submit" name="to" class="button" value="つぶやく">
            </div>
        </form>
        <br>
        <hr>
        <br><br>
        <?php
            const DB_HOST = 'localhost';
            const DB_NAME = 'intern';
            const DB_USER = 'root';
            const DB_PASSWORD = 'root';
            const T_NAME = 'board';
            //データベース接続
            try {
                $db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASSWORD );
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                die('エラーメッセージ：'.$e->getMessage());
            }

            $sql = "SELECT * FROM board WHERE delete_flag = 0 ORDER BY id DESC";
            $stmt = $db->query($sql);
        ?>
        <?php
            foreach($stmt as $row){
        ?>
            <div class="a">
                <div class="back">
                    <?php echo '<strong>'.$row['post_name'].'</strong>'; ?>
                    &ensp; 
                    <?php echo date('Y年m月d日 H:i', strtotime($row['create_at'])); ?>
                    <?php echo '<br>'; ?>
                    <?php echo '<br>'; ?>
                    <?php echo $row['message']; ?>
                    <form  method="post" action="delete.php">
                        <input type="hidden" name="delid" value=<?php echo $row['id'];?>>
                        <input type="submit" class="dis" value="削除">
                    </form>
                </div>
            </div>
        <?php
            }
            $mysqli->close();
        ?>
    </body>
</html>