<?php
//Fileアップロードチェック

// var_dump($_FILES["upfile"]);

// exit;

if (isset($_FILES["upfile"] ) && $_FILES["upfile"]["error"] ==0 ) {
    //情報取得
    $file_name = $_FILES["upfile"]["name"];         //"1.jpg"ファイル名取得
    $tmp_path  = $_FILES["upfile"]["tmp_name"]; //"/usr/www/tmp/1.jpg"アップロード先のTempフォルダ
    $file_dir_path = "upload/";  //画像ファイル保管先を指定

    
    //***File名の変更***
    //同じファイル名で保存しても上書きされないようにする処理
    $extension = pathinfo($file_name, PATHINFO_EXTENSION); //「pathinfo_extension」拡張子の情報を取得(jpg, png, gif)
    $uniq_name = date("YmdHis").md5(session_id()) . "." . $extension;  //ユニークファイル名作成：date関数とmd5を使って固有のファイル名を生成する
    $file_name = $file_dir_path.$uniq_name; //ユニークファイル名とパス
   

    $img="";  //画像表示orError文字を保持する変数
    // FileUpload [--Start--]
    if ( is_uploaded_file( $tmp_path ) ) { //ファイルがアップされたかどうかをチェック
        if ( move_uploaded_file( $tmp_path, $file_name ) ) { //保存先をtempフォルダから移動させる（$どのファイルを, $どこのフォルダに）
            chmod( $file_name, 0644 ); //権限「0644」を付与
            $img = '<img src="'. $file_name . '" >'; //画像表示用HTML（⇛アップロードしたら表示される）
        } else {
            $img = "Error:アップロードできませんでした。"; //Error文字
        }
    }
    // FileUpload [--End--]
}else{
    $img = "画像が送信されていません"; //Error文字
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FileUploadテスト</title>
</head>
<body>
    <?=$img?>
</body>
</html>
