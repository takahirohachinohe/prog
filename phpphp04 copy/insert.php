<?php
//1. POSTデータ取得
$bookname   = $_POST["bookname"];
$bookurl    = $_POST["bookurl"];
$bookcoment = $_POST["bookcoment"];
 //追加されています


//2. DB接続します
//*** function化する！  *****************
include("funcs.php");//外部の関数を呼び込む(呼び込むだけ)

$pdo = db_conn();//$pdoに＄pの情報が代入されます


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(bookname,bookurl,bookcoment,indate)VALUES(:bookname,:bookurl,:bookcoment,sysdate())");
$stmt->bindValue(':bookname',   $bookname,   PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookurl',    $bookurl,    PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookcoment', $bookcoment, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
//*** function化する！*****************
    sql_error($stmt);
}else{
    //*** function化する！*****************

    redirect("index.php");
}
?>
