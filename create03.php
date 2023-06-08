<?php
var_dump($_POST);
exit;

// セッションの開始
session_start();
// データ受け取り
include("functions.php");
check_session_id();
// ユーザーIDの取得
$user_id = $_SESSION['user_id'];

    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    // $img_name = $_FILES['img']['name'];
    // $img_tmp = $_FILES['img']['tmp_name'];
	// 一時保存先（tmp_name）
    // $img_dir = './data/' . $img_name;

	 // 画像を保存（一時保存先からdataへ）
    // move_uploaded_file($img_tmp, $img_dir);

	if (
  !isset($_POST['name']) || $_POST['name'] === '' ||
  !isset($_POST['birthday']) || $_POST['birthday'] === ''||
    !isset($_POST['height']) || $_POST['height'] === '' ||
  !isset($_POST['weight']) || $_POST['weight'] === ''
	)
    // !isset($_POST['img']) || $_POST['img'] === '' 

 {
  exit('ParamError');
}


// DB接続
$pdo = connect_to_db();

 // 「dbError:...」が表示されたらdb接続でエラーが発生していることがわかる．

// SQL作成&実行
$sql = 'INSERT INTO PHP_SSK_child (user_id, name, birthday, height,weight,created_at, updated_at) VALUES (:user_id, :name, :birthday, :height,:weight,now(), now())';

$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':birthday', $birthday, PDO::PARAM_STR);
$stmt->bindValue(':height', $height, PDO::PARAM_STR);
$stmt->bindValue(':weight', $weight, PDO::PARAM_STR);
// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// データ入力画面に移動する
header("Location:input00.php");
exit();





    

?>

