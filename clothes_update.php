<?php
session_start();
include("functions.php");
check_session_id();
// ユーザーIDの取得
$user_id = $_SESSION['user_id'];
$clothes_id = $_POST['clothes_id'];

// パラメータのバリデーション
if (
    !isset($_POST['size']) || $_POST['size'] === '' ||
    !isset($_POST['maker']) || $_POST['maker'] === '' ||
    !isset($_POST['type']) || $_POST['type'] === '' ||
    !isset($_POST['date']) || $_POST['date'] === ''
) {
    exit('ParamError');
}

$size = $_POST['size'];
$maker = $_POST['maker'];
$type = $_POST['type'];
$date = $_POST['date'];

$pdo = connect_to_db();

// 前の画像パスを取得
$prev_img_path = '';
$sql = 'SELECT img FROM PHP_SSK_clothes WHERE clothes_id = :clothes_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':clothes_id', $clothes_id, PDO::PARAM_INT);
try {
    $stmt->execute();
    $prev_img_path = $stmt->fetchColumn();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

// 画像がアップロードされた場合の処理
if ($_FILES['img']['error'] === UPLOAD_ERR_OK) {
    // アップロードされた画像を保存する処理
    $img_name = $_FILES['img']['name'];
    $img_tmp = $_FILES['img']['tmp_name'];
    $img_dir = './data/' . $img_name;
    move_uploaded_file($img_tmp, $img_dir);

    // 新しい画像がアップロードされた場合、前の画像を削除
    if (file_exists($prev_img_path)) {
        unlink($prev_img_path);
    }
} else {
    // 画像がアップロードされなかった場合、前の画像パスを使用する
    $img_dir = $prev_img_path;
}

$sql = "UPDATE PHP_SSK_clothes SET size=:size, maker=:maker, type=:type, img=:img, date=:date, updated_at=now() WHERE clothes_id=:clothes_id";

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

header("Location: childpage.php");
exit();
?>
