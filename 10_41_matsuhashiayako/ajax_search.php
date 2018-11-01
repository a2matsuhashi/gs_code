<?php
session_start();

//0.外部ファイル読み込み
include("funcs.php");

//ログインチェック
loginCheck();

//POST
if(!isset($_POST["search"]) && $_POST["search"]==""){
    $s = "";
}else{
    $s = $_POST["search"];
}

//1.  DB接続します
$pdo = db_con();

//２．データ登録SQL作成
if($s!=""){
    $stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE name LIKE :s");
    $stmt->bindValue(":s", "%".$s."%", PDO::PARAM_STR);
}else{
    $stmt = $pdo->prepare("SELECT * FROM gs_bm_table"); 
}
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
    echo "false";
}else{
    //Selectデータの数だけ自動でループしてくれる
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
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
    echo $view;
}
?>
