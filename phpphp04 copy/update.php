<?php
//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//   POSTデータ受信 → DB接続 → SQL実行 → 前ページへ戻る
//2. $id = POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更




//1. POSTデータ取得
$bookname  = $_POST["bookname"];
$bookurl   = $_POST["bookurl"];
$bookcoment= $_POST["bookcoment"];
$id        = $_POST["id"];//hiddenのデータ



//2. DB接続します
//*** function化する！  *****************
include("funcs.php");//外部の関数を呼び込む(呼び込むだけ)

$pdo = db_conn();//$pdoに＄pの情報が代入されます


//３．データ登録SQL作成
$sql = "UPDATE gs_bm_table SET bookname=:bookname,bookurl=:bookurl,bookcoment=:bookcoment WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':bookname', $bookname, PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookurl', $bookurl, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookcoment', $bookcoment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);          //Integer（数値の場合 PDO::PARAM_INT)

$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    //*** function化する！*****************
    sql_error($stmt);
}else{
    //*** function化する！*****************
    redirect("select.php");
}




?>
