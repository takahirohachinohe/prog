<?php
//１．PHP
//select.phpのPHPコードをマルっとコピーしてきます。
//※SQLとデータ取得の箇所を修正します。
//【重要】
//insert.phpを修正（関数化）してからselect.phpを開く！！
include("funcs.php");
$pdo = db_conn();

//データ取得(?id=***)
$id = $_GET["id"];
echo $id;
exit();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);        //Integer（数値の場合 PDO::PARAM_INT)

$status = $stmt->execute();


//３．データ表示
$view="";
if($status==false) {
sql_error();
}else{
    $r = $stmt->fetch();//1レコードとわかってる場合の取得
}




?>
<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
理由：入力項目は「登録/更新」はほぼ同じになるからです。
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>データ登録</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
<nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
</nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="update.php">
<div class="jumbotron">
<fieldset>
    <legend>フリーアンケート</legend>
    <label>著者：<input type="text" name="bookname" value="<?=$r["bookname"]?>"></label><br>
    <label>URL：<input type="text" name="bookurl" value="<?=$r["bookurl"]?>"></label><br>
    <label>コメント：<input type="text" name="bookcoment" value="<?=$r["bookcoment"]?>"></label><br>
    <input type="text" name="id" value="<?=$r["id"]?>">
    <input type="submit" value="送信">
    </fieldset>
</div>
</form>
<!-- Main[End] -->


</body>
</html>



