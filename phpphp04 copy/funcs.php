<?php
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続関数：db_conn()
function db_conn(){
    try {
        
        
        $db_name = "gs_de5";    //データベース名
        $db_id   = "root";      //アカウント名
        $db_pw   = "root";      //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = "localhost"; //DBホスト
        $p = new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
        return $p;
    } catch (PDOException $e) {
        exit('DB Connection Error:'.$e->getMessage());
    }
}




//SQLエラー関数：sql_error($stmt) 第一引数、第二引数
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
    }



//リダイレクト関数: redirect($file_name)
function redirect($filename){
    header("Location: $filename");
    exit();
}




