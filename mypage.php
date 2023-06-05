<?php
// セッションの開始
session_start();
// データ受け取り
include("functions.php");
check_session_id();


// ユーザーIDの取得
$user_id = $_SESSION['user_id'];

// DB接続
$pdo = connect_to_db();

// ユーザーのデータを取得するSQL
$sql = 'SELECT * FROM user_data WHERE user_id = :user_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$user_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>マイページ</title>
</head>
<body>
    <h1>マイページ</h1>
    <h2>登録データ</h2>
    <table>
        <tr>
            <th>サイズ</th>
            <th>メーカー</th>
            <th>タイプ</th>
            <th>日付</th>
        </tr>
        <?php foreach ($user_data as $data): ?>
            <tr>
                <td><?php echo $data['size']; ?></td>
                <td><?php echo $data['maker']; ?></td>
                <td><?php echo $data['type']; ?></td>
                <td><?php echo $data['date']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="input00.php">子供情報入力画面</a>
	<a href="input01.php">服入力画面</a>
    <a href="logout.php">logout</a>
</body>
</html>
