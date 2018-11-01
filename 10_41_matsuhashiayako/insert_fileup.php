<?php
include("funcs.php");
//入力チェック(受信確認処理追加)
if(
  !isset($_POST["title"]) || $_POST["title"]=="" ||
  !isset($_POST["author"]) || $_POST["author"]=="" ||
  !isset($_POST["memo"]) || $_POST["memo"]==""
){
  exit('ParamError');
}

//1. POSTデータ取得
$title = $_POST["title"];
$author = $_POST["author"];
$memo = $_POST["memo"];

//****************************************************
//Fileアップロードチェック
//****************************************************
if (isset($_FILES["upfile"] ) && $_FILES["upfile"]["error"] ==0 ) {
  //情報取得
  $file_name = $_FILES["upfile"]["name"];         //"1.jpg"ファイル名取得
  $tmp_path  = $_FILES["upfile"]["tmp_name"]; //"/usr/www/tmp/1.jpg"アップロード先のTempフォルダ
  $file_dir_path = "upload/";  //画像ファイル保管先

  //***File名の変更***
  $extension = pathinfo($file_name, PATHINFO_EXTENSION); //拡張子取得(jpg, png, gif)
  $uniq_name = date("YmdHis").md5(session_id()) . "." . $extension;  //ユニークファイル名作成
  $file_name = $file_dir_path.$uniq_name; //ユニークファイル名とパス
 
  $img="";  //画像表示orError文字を保持する変数
  // FileUpload [--Start--]
  if ( is_uploaded_file( $tmp_path ) ) {
      if ( move_uploaded_file( $tmp_path, $file_name ) ) {
          chmod( $file_name, 0644 ); //画像のパーミッション設定
      } else {
          exit("Error:アップロードできませんでした。"); //Error文字
      }
  }
  // FileUpload [--End--]
}else{
  exit("画像が送信されていません"); //Error文字
}

//2. DB接続します(エラー処理追加)
$pdo = db_con();

//３．データ登録SQL作成
// $stmt = $pdo->prepare("INSERT INTO gs_an_table(id, name, email, naiyou,
// indate )VALUES(NULL, :a1, :a2, :a3, sysdate())");
$stmt = $pdo->prepare("INSERT INTO gs_bm_table( title,author,memo,image,date )VALUES( :title,:author,:memo,:image,sysdate() )");
$stmt->bindValue(':title', $title, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':author', $author, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':memo', $memo, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':image', $file_name, PDO::PARAM_STR);  //画像のパスを挿入
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  queryError($stmt);

}else{
  //５．index.phpへリダイレクト
  header("Location: select.php");
  exit;
}
?>
