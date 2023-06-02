<?php
// データ受け取り
include("functions.php");

// セッションの開始
session_start();

// ユーザーIDの取得
$user_id = $_SESSION['user_id'];

// フォームデータの受け取り
$size = $_POST['size'];
$maker = $_POST['maker'];
$type = $_POST['type'];
$date = $_POST['date'];
$img_name = $_FILES['img']['name'];
$img_tmp = $_FILES['img']['tmp_name'];

// ユニークなIDを生成
$unique_id = uniqid();

// 画像の保存先ディレクトリ
$img_dir = './data/' . $unique_id . '_' . $img_name;

// 画像を保存（一時保存先からdataへ）
move_uploaded_file($img_tmp, $img_dir);

if (
  !isset($_POST['size']) || $_POST['size'] === '' ||
  !isset($_POST['maker']) || $_POST['maker'] === '' ||
  !isset($_POST['type']) || $_POST['type'] === '' ||
  !isset($_POST['date']) || $_POST['date'] === '' ||
  !isset($_FILES['img']) || $_FILES['img']['name'] === ''
) {
  exit('ParamError');
}

// DB接続
$pdo = connect_to_db();

// データ登録のSQL
$sql = 'INSERT INTO PHP_SSK_clothes (user_id, size, maker, type, date, img, created_at, updated_at) VALUES (:user_id, :size, :maker, :type, :date, :img, NOW(), NOW())';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':size', $size, PDO::PARAM_STR);
$stmt->bindValue(':maker', $maker, PDO::PARAM_STR);
$stmt->bindValue(':type', $type, PDO::PARAM_STR);
$stmt->bindValue(':date', $date, PDO::PARAM_STR);
$stmt->bindValue(':img', $img_dir, PDO::PARAM_STR);
$stmt->execute();

// データ入力画面に移動する
header("Location: input01.php");
exit();
?>
