<?php
//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$bookname  =  $_POST["bookname"];
$bookurl  =  $_POST["bookurl"];
$bookcoment  =  $_POST["bookcoment"];

//2. DB接続します
include("funcs.php");
$pdo = dbcon();


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table( bookname,bookurl,bookcoment,indate )VALUES( :bookname,:bookurl,:bookcoment,sysdate())");
$stmt->bindValue(':bookname', $bookname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookurl', $bookurl, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookcoment', $bookcoment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //結果:false=エラー

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
$error = $stmt->errorInfo();//エラー取得の関数→配列で戻してくる
    exit("SQLError:".$error[2]);
}else{
  //５．index.phpへリダイレクト
header ("Location: index.php");
    exit();
}
?>