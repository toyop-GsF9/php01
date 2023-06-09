<?php
session_start();
include("functions.php");
check_session_id();
// ユーザーIDの取得
$user_id = $_SESSION['user_id'];
$child_id = $_POST['child_id'];
// var_dump($child_id);
// exit();


	if (
  !isset($_POST['name']) || $_POST['name'] === '' ||
  !isset($_POST['birthday']) || $_POST['birthday'] === ''||
    !isset($_POST['height']) || $_POST['height'] === '' ||
  !isset($_POST['weight']) || $_POST['weight'] === ''  ||
  !isset($_FILES['img']) || $_FILES['img'] === '' 
	)
 {
  exit('ParamError');
}
  $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $img_name = $_FILES['img']['name'];
    $img_tmp = $_FILES['img']['tmp_name'];
	// // 一時保存先（tmp_name）
    $img_dir = './data/' . $img_name;
//   var_dump($img_dir);
// exit();
	//  画像を保存（一時保存先からdataへ）
    move_uploaded_file($img_tmp, $img_dir);
	
// var_dump($img_dir);
// exit();

$pdo = connect_to_db();

$sql = "UPDATE PHP_SSK_child SET name=:name, birthday=:birthday, height=:height,img=:img, weight=:weight, updated_at=now() WHERE child_id=:child_id";

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

header("Location:childpage.php");
exit();
