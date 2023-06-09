<?php
session_start();
include("functions.php");
check_session_id();
// ユーザーIDの取得
$user_id = $_SESSION['user_id'];
$clothes_id = $_POST['clothes_id'];
// var_dump($clothes_id);
// exit();


	if (
  !isset($_POST['size']) || $_POST['size'] === '' ||
  !isset($_POST['maker']) || $_POST['maker'] === ''||
    !isset($_POST['type']) || $_POST['type'] === '' ||
  !isset($_POST['date']) || $_POST['date'] === ''  ||
  !isset($_FILES['img']) || $_FILES['img'] === '' 
	)
 {
  exit('ParamError');
}
  $size = $_POST['size'];
    $maker = $_POST['maker'];
    $type = $_POST['type'];
    $date = $_POST['date'];
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

$sql = "UPDATE PHP_SSK_clothes SET size=:size, maker=:maker, type=:type,img=:img, date=:date, updated_at=now() WHERE clothes_id=:clothes_id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':size', $size, PDO::PARAM_STR);
$stmt->bindValue(':maker', $maker, PDO::PARAM_STR);
$stmt->bindValue(':type', $type, PDO::PARAM_STR);
$stmt->bindValue(':date', $date, PDO::PARAM_STR);
$stmt->bindValue(':clothes_id', $clothes_id, PDO::PARAM_INT);
$stmt->bindValue(':img', $img_dir, PDO::PARAM_STR);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:childpage.php");
exit();
