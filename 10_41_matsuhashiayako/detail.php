<?php
session_start();
include "funcs.php"; //funcs.phpを読み込む

//ログインチェック
loginCheck();

$id = $_GET["id"];
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    sqlError($stmt);
} else {
    $row = $stmt->fetch();
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title></title>
  <link href="css/style.css" rel="stylesheet">
  <script src="./ckeditor/ckeditor.js"></script>
</head>
<body>
<!-- Head[Start] -->
<header>
<h1>BOOKMARK DETAILS</h1>
</header>
<!-- Head[End] -->

<!-- BOOKMARK START-->
<form method="post" action="update.php" enctype="multipart/form-data">
<h2>BOOKMARK</h2>
<div class="bm">
<div class="bm_left">
  <p>
    <label>Title</label>
      <input type="text" name="title" value="<?=$row["title"]?>">
  </p>
  <p>
    <label>Author</label>
      <input type="text" name="author" value="<?=$row["author"]?>">
  </p>
</div>
<div class="bm_right">
  <p>
   <label>Memo</label>
      <textArea name="memo" id="editor1" rows="4" cols="40"><?=$row["memo"]?></textArea>
  </p>
</div>
</div>
    <script>
      CKEDITOR.replace( 'editor1' );
    </script>
<input type="hidden" name="id" value="<?=$row["id"]?>">
<div class="bm_button">
  <input type="submit" value="Updata">
  <button type="button" class="button"><a href="select.php">List</a></button>
</div>
</form>
<!-- BOOKMARK END -->



</body>
</html>
