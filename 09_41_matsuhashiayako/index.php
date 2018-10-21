<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Head[Start] -->
<header>
<!-- ヘッダー左：サイトタイトル -->
<div class="h_left">
  <h1>BOOKMARK</h1>
</div>
<!-- ヘッダー右：ログイン -->
<div class="h_right">
  <form name="form1" action="login_act.php" method="post">
  <p>  
    <label for="id">ID</label>
    <input type="text" name="lid" />
  </p>
  <p>
    <label for="password">Password</label>
    <input type="password" name="lpw" />
  </p>
  <p><input type="submit" value="Login" /></p>
  </form>
  <p><a href="user.php">Create your account</a></p>
</div>
</header>
<!-- Head[End] -->

    <!-- <a class="navbar-brand" href="select.php">データ一覧</a> -->

<!-- Main[Start] -->
<form method="post" action="insert.php">
<h2>BOOKMARK</h2>
  <p>
    <label>Title</label>
      <input type="text" name="title">
  </p>
  <p>
    <label>Author</label>
      <input type="text" name="author">
  </p>
  <p>
   <label>Memo</label>
      <textArea name="memo" rows="4" cols="40"></textArea>
  </p>
  <input type="submit" value="Register">
  <button type="button" class="button"><a href="f_select.php">List</a></button>
</form>

<!-- Main[End] -->


</body>
</html>
