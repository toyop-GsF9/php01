<?php
// データ受け取り
include("functions.php");

// ログイン処理を行うPHPのコード
$email = $_POST['email'];
$password = $_POST['password'];

if (
  !isset($_POST['email']) || $_POST['email'] === '' ||
  !isset($_POST['password']) || $_POST['password'] === ''
) {
  exit('ParamError');
}

// DB接続
$pdo = connect_to_db();

// SQL作成&実行
$sql = 'SELECT * FROM PHP_SSK_login WHERE email = :email';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// ユーザーが存在するかチェックし、パスワードを検証する
if (!$user || !password_verify($password, $user['password'])) {
  exit('LoginError');
}

// セッションの開始
session_start();

// ユーザー情報をセッションに保存
$_SESSION['user_id'] = $user['ID'];
$_SESSION['email'] = $user['email'];

// ログイン成功後にマイページにリダイレクト
header('Location: mypage.php');
?>
