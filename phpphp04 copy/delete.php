<?php

//1. POSTデータ取得
$id     = $_GET["id"];//GETのIDを取得
//2. DB接続します
//*** function化する！  *****************
include("funcs.php");//外部の関数を呼び込む(呼び込むだけ)

$pdo = db_conn();//$pdoに＄pの情報が代入されます


//３．データ登録SQL作成
$sql =  "DELETE FROM gs_bm_table WHERE id=:id"; //削除
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);        //Integer（数値の場合 PDO::PARAM_INT)
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
