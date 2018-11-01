<?php
session_start();
include "funcs.php"; //funcs.phpを読み込む

//ログインチェック
loginCheck();

$id = $_GET["id"];
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
  <title></title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Head[Start] -->
<header>
<h1>User List</h1>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="user_update.php">
  <p>
    <label>Name</label>
      <input type="text" name="name" value="<?=$row["name"]?>">
  </p>
  <p>
    <label>ID</label>
      <input type="text" name="lid" value="<?=$row["lid"]?>">
  </p>
  <p>
   <label>Password</label>
   <input type="text" name="lpw" value="<?=$row["lpw"]?>">
  </p>
  <input type="hidden" name="id" value="<?=$row["id"]?>">
  <input type="submit" value="Updata">
  <button type="button" class="button"><a href="user_list_view.php">User List</a></button>
</form>
<!-- Main[End] -->


</body>
</html>
