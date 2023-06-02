<?php

    $dish = $_POST['dish'];
    $date = $_POST['date'];
    $timing = $_POST['timing'];
    $genre = $_POST['genre'];
    $img_name = $_FILES['img']['name'];
    $img_tmp = $_FILES['img']['tmp_name'];
	// 一時保存先（tmp_name）
    $img_dir = './data/' . $img_name;

	 // 画像を保存（一時保存先からdataへ）
    move_uploaded_file($img_tmp, $img_dir);

	if (
  !isset($_POST['dish']) || $_POST['dish'] === '' ||
  !isset($_POST['date']) || $_POST['date'] === ''||
    !isset($_POST['timing']) || $_POST['timing'] === '' ||
  !isset($_POST['genre']) || $_POST['genre'] === ''||
    !isset($_POST['img']) || $_POST['img'] === '' 

) {
  exit('ParamError');
}

// データ受け取り
include("functions.php");
// DB接続
$pdo = connect_to_db();

 // 「dbError:...」が表示されたらdb接続でエラーが発生していることがわかる．

// SQL作成&実行
$sql = 'INSERT INTO todo_table (id, todo, deadline, created_at, updated_at) VALUES (NULL, :todo, :deadline, now(), now())';

$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':todo', $todo, PDO::PARAM_STR);
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// データ入力画面に移動する
header("Location:index.php");
exit();





    

?>

