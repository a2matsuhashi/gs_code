<?php
session_start();
include("funcs.php");

//ログインチェック
loginCheck();

//DB接続
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    sqlError($stmt);
} else {
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {        
        $view .= '<div class="col">';
        $view .= '<a href="detail.php?id=' . $result["id"] . '">';
        $view .= '<img src="img/pencil.png" width="20px">';
        $view .= '</a>';
        $view .= '<a href="delete.php?id=' . $result["id"] . '">';
        $view .= '<img src="img/delete.png" width="20px">';
        $view .= '</a>';
        $view .= '<img src="'.$result["image"].'">';
        $view .= '<h3>'. $result["title"] .'</h3>';
        $view .= '<p>'. $result["author"].'</p>';
        $view .= '<p>'. $result["memo"].'</p>';
        $view .= '</div>';
    }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" href="css/style.css">
<script src="./ckeditor/ckeditor.js"></script>
</head>
<body>
<!-- Head[Start] -->
<header>
    <h1>BOOKMARK LIST</h1>
    <p>
    <input type="text" name="search" class="search" placeholder="キーワード検索">
    <button id="btn">検索</button>
</p>
</header>
<!-- Head[End] -->
<!-- Main[Start] -->
<p class="a"><a href="index.php">TOP</a>
<a href="user_list_view.php">User List</a>
<a href="logout.php">Logout</a></p>

<!-- BOOKMARK START-->
<form method="post" action="insert_fileup.php" enctype="multipart/form-data">
<h2>BOOKMARK</h2>
<div class="bm">
<div class="bm_left">
  <p>
    <label>Title</label>
      <input type="text" name="title">
  </p>
  <p>
    <label>Author</label>
      <input type="text" name="author">
  </p>
  <p>
    <label>Image</label>
      <input type="file" name="upfile">
  </p>
</div>
<div class="bm_right">
  <p>
   <label>Memo</label>
      <textArea name="memo" id="editor1" rows="4" cols="40"></textArea>
  </p>
</div>
</div>
    <script>
      CKEDITOR.replace( 'editor1' );
    </script>
<div class="bm_button">
  <input type="submit" value="Register">
</div>
</form>
<!-- BOOKMARK END -->

<!-- LIST START -->
<div class="cols">
<?=$view?>
</div>
<!-- LIST END -->

<!-- SEARCH -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script>
  $('#btn').on('click', function(){
    $.ajax({
      type: 'POST',
      url: 'ajax_search.php',
      cache: false,
      data: {
        search: $('.search').val()
      },
      dataType: 'html',
      success: function(data){
        console.log(data);
        $('.cols').empty().append(data);
      },
      error: function(){
      }
    });
  });
</script>

</body>
</html>
