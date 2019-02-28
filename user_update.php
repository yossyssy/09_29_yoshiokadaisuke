<?php
// 関数ファイル読み込み
include('functions.php');
//var_dump($_POST);
//exit();
//入力チェック(受信確認処理追加)

if (
    !isset($_POST['name']) || $_POST['name']=='' ||
    !isset($_POST['publish']) || $_POST['publish']=='' ||
    !isset($_POST['description']) || $_POST['description']==''
) {
    exit('ParamError');
}

//POSTデータ取得
$id = $_POST['id'];
$name = $_POST['name'];
$publish = $_POST['publish'];
$description = $_POST['description'];

//DB接続します(エラー処理追加)
$pdo = db_conn();

//データ登録SQL作成
$sql = 'UPDATE videos SET name=:a1, publish=:a2, description=:a3  WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $name, PDO::PARAM_STR);
$stmt->bindValue(':a2', $publish, PDO::PARAM_STR);
$stmt->bindValue(':a3', $description, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ登録処理後
if ($status==false) {
    errorMsg($stmt);
} else {
    header('Location: select.php');
    exit;
}
