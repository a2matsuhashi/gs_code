<?php
session_start();
include "funcs.php";

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
        $view .= '<tr>';
        $view .= '<td><a href="delete.php?id=' . $result["id"] . '">';
        $view .= "X";
        $view .= '</a></td>';
        $view .= '<td><a href="detail.php?id=' . $result["id"] . '">';
        $view .= $result["title"]. '</td></a>' ;
        $view .= '<td>'. $result["author"].'</td>';
        $view .= '</tr>';
    }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" href="css/style.css">
</head>
<body id="main">
<!-- Head[Start] -->
<header>
    <h1>BOOKMARK LIST</h1>
</header>
<!-- Head[End] -->
<!-- Main[Start] -->
<p class="a"><a href="index.php">TOP</a>　
<a href="user_list_view.php">User List</a>　
<a href="logout.php">Logout</a></p>
<table>
    <thead>
        <tr>
            <th>Delete</th>
            <th>Title</th>
            <th>Author</th>
        </tr>
    </thead>
    <tbody>
        <?=$view?>
    </tbody>
</table>
</div>
<!-- Main[End] -->

</body>
</html>
