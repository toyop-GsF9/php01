<?php
// セッションの開始
session_start();
// データ受け取り
include("functions.php");


// ログイン処理を行うPHPのコード
$email = $_POST['email'];
$password = $_POST['password'];

// DB接続
$pdo = connect_to_db();

// username，password，deleted_atの3項目全ての条件満たすデータを抽出する．
$sql = 'SELECT * FROM PHP_SSK_login WHERE email=:email AND deleted_at IS NULL';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$user = $stmt->fetch(PDO::FETCH_ASSOC);

// ユーザーが存在するかチェックし、パスワードを検証する
if (!$user || !password_verify($password, $user['password'])){
  echo "<p>ログイン情報に誤りがあります</p>";
  echo "<a href=login.html>ログイン</a>";
  exit();
} else {
  $_SESSION = array();
  $_SESSION['session_id'] = session_id();
  $_SESSION['user_id'] = $user['ID'];
  // $_SESSION['is_admin'] = $user['is_admin'];
  // $_SESSION['username'] = $user['username'];
  header("Location:childpage.php");
  exit();
}


// ログイン成功後にマイページにリダイレクト
// header('Location: lnput01.php');
?>
