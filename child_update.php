<?php
session_start();
include("functions.php");
check_session_id();
// ユーザーIDの取得
$user_id = $_SESSION['user_id'];
$child_id = $_POST['child_id'];

if (
  !isset($_POST['name']) || $_POST['name'] === '' ||
  !isset($_POST['birthday']) || $_POST['birthday'] === '' ||
  !isset($_POST['height']) || $_POST['height'] === '' ||
  !isset($_POST['weight']) || $_POST['weight'] === '' 
  
) {
  exit('ParamError');
}

$name = $_POST['name'];
$birthday = $_POST['birthday'];
$height = $_POST['height'];
$weight = $_POST['weight'];

$pdo = connect_to_db();

// 前の画像パスを取得
$prev_img_path = '';
$sql = 'SELECT img FROM PHP_SSK_child WHERE child_id = :child_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':child_id', $child_id, PDO::PARAM_INT);
try {
  $stmt->execute();
  $prev_img_path = $stmt->fetchColumn();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$img_name = $_FILES['img']['name'];
$img_tmp = $_FILES['img']['tmp_name'];
$img_dir = './data/' . $img_name;

// 画像を保存（一時保存先からdataへ）
move_uploaded_file($img_tmp, $img_dir);

// 画像の更新かどうかを判定
if (!empty($img_name)) {
  // 新しい画像がアップロードされた場合、前の画像を削除
  if (file_exists($prev_img_path)) {
    unlink($prev_img_path);
  }
} else {
  // 新しい画像がアップロードされなかった場合、前の画像パスを使用
  $img_dir = $prev_img_path;
}

$sql = "UPDATE PHP_SSK_child SET name=:name, birthday=:birthday, height=:height, img=:img, weight=:weight, updated_at=now() WHERE child_id=:child_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':birthday', $birthday, PDO::PARAM_STR);
$stmt->bindValue(':height', $height, PDO::PARAM_STR);
$stmt->bindValue(':weight', $weight, PDO::PARAM_STR);
$stmt->bindValue(':child_id', $child_id, PDO::PARAM_INT);
$stmt->bindValue(':img', $img_dir, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location: childpage.php");
exit();
