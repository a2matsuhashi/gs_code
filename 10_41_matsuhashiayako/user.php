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
<h1>Create your account</h1>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="user_insert.php">
  <p>
    <label>Name</label>
      <input type="text" name="name">
  </p>
  <p>
    <label>ID</label>
      <input type="text" name="lid">
  </p>
  <p>
   <label>Password</label>
   <input type="text" name="lpw">
  </p>
  <input type="submit" value="Creat">
  <button type="button" class="button"><a href="index.php">TOP</a></button>
</form>
<!-- Main[End] -->
</body>
</html>
