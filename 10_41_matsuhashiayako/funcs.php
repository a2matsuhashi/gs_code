<?php
//共通に使う関数を記述

function h($a)
{
    return htmlspecialchars($a, ENT_QUOTES);
}

//DB接続
// function db_con()
// {
//     try {
//         return new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root', ''); //XAMP
//         //return new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root', 'root'); //MAMP
//     } catch (PDOException $e) {
//         exit('DB_CONECTION_ERROR:' . $e->getMessage());
//     }
// }

function db_con(){
    $dbname='gs_db';
    try {
      $pdo = new PDO('mysql:dbname='.$dbname.';charset=utf8;host=localhost','root','');
    } catch (PDOException $e) {
      exit('DbConnectError:'.$e->getMessage());
    }
    return $pdo;
  }

function sqlError($stmt)
{
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("SQL_ERROR:" . $error[2]);
}

//LOGINチェック
function loginCheck(){
    if(
        !isset($_SESSION["chk_ssid"]) || 
        $_SESSION["chk_ssid"] != session_id()
        ){
            echo "LOGIN ERROR";
            exit();
        }else{ //ログイン認証ができたら実行される処理
            session_regenerate_id(true); //古いセッションIDを削除
            $_SESSION["chk_ssid"] = session_id(); //新しいセッションIDを生成
        }
}

?>