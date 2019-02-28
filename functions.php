<?php
//共通で使うものを別ファイルにしておきましょう。

//DB接続関数（PDO）
function db_conn()
{
    //DB接続
    $dbname = 'gs_f02_db29';
$dbn = 'mysql:dbname='.$dbname.';charset=utf8;port=3306;host=localhost';
$user = 'root';
$pwd = 'root';

try {
    return new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
    exit('dbError:'.$e->getMessage());
}

}


//SQL処理エラー
function errorMsg($stmt)
{
    $error = $stmt->errorInfo();
    exit('ErrorQuery:'.$error[2]);
}

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// SESSIONチェック＆リジェネレイト
function chk_ssid()
{
    if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid']!=session_id())
    // ログイン失敗時の処理（ログイン画面に移動）
     header('Location: login.php');
        // ログイン成功時の処理（一覧画面に移動）
     else{
         session_regenerate_id(true);
         $_SESSION['chk_ssid'] = session_id();
     }   
}

// menuを決める
function menu()
{
    $menu = '<li class="nav-item"><a class="nav-link" href="index.php">新着動画登録</a></li><li class="nav-item"><a class="nav-link" href="select.php">新着動画一覧</a></li>';
    $menu .= '<li class="nav-item"><a class="nav-link" href="logout.php">ログアウト</a></li>';
    return $menu;
}

