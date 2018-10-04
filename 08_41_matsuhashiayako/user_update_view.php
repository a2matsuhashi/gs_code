<?php
$id = $_GET["id"];
include "funcs.php"; //funcs.phpを読み込む
$pdo = db_con(); //DB接続

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    sqlError($stmt); //エラー処理
} else {
    $row = $stmt->fetch();
}
?>

<!-- index.php（登録フォームの画面ソースコードを全コピーして、このファイルをまるっと上書き保存） -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="user_list_view.php">ユーザー一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="user_update.php">
  <div class="jumbotron">
  <fieldset>
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー登録</legend>
     <label>名前：<input type="text" name="name"  value="<?=$row["name"]?>"></label><br>
     <label>ID：<input type="text" name="lid"  value="<?=$row["lid"]?>"></label><br>
     <label>パスワード：<input type="text" name="lpw"  value="<?=$row["lpw"]?>"></label><br>
    <!-- idでデータを引っ張る -->
    <input type="hidden" name="id" value="<?=$row["id"]?>">
     <input type="submit" value="登録">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
