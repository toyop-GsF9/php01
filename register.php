<?php
// データ受け取り
include("functions.php");

// 登録処理を行うPHPのコード
$email = $_POST['email'];
$password = $_POST['password'];

if (
  !isset($_POST['email']) || $_POST['email'] === '' ||
  !isset($_POST['password']) || $_POST['password'] === ''
) {
  exit('ParamError');
}

// パスワードのハッシュ化
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// DB接続
$pdo = connect_to_db();

// SQL作成&実行
$sql = 'INSERT INTO PHP_SSK_login(ID, email, password, created_at, updated_at) VALUES (NULL, :email, :password, now(), now())';

$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', $hashed_password, PDO::PARAM_STR);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// 登録成功後にログインページにリダイレクトする例
header('Location: login.html');
?>
