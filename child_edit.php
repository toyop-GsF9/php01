<?php
session_start();

include("functions.php");
check_session_id();

$user_id = $_SESSION['user_id'];
$child_id = $_GET['child_id'];


$pdo = connect_to_db();

// 子供データ用
$sql = 'SELECT * FROM `PHP_SSK_child` WHERE user_id=:user_id AND child_id=:child_id';

$child_stmt = $pdo->prepare($sql);

$child_stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$child_stmt->bindValue(':child_id', $child_id, PDO::PARAM_INT);

try {
  $status = $child_stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$child_data= $child_stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>子供情報更新画面</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 20px;
    }

    form {
      max-width: 400px;
      margin: 0 auto;
      background-color: #fff;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    legend {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    a {
      display: block;
      margin-bottom: 10px;
      color: #333;
      text-decoration: none;
      font-size: 16px;
    }

    a:hover {
      color: #ff6f00;
    }

    div {
      margin-bottom: 20px;
    }

    input[type="text"],
    input[type="date"],
    input[type="number"],
    input[type="file"]  {
      width: 90%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      background-color: #ff6f00;
      color: #fff;
      border: none;
      border-radius: 4px;
      padding: 10px 20px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #ff9000;
    }
  </style>
</head>

<body>
  <form action="child_update.php" method="POST" enctype="multipart/form-data">
    
    <fieldset>
      <legend>子供情報更新</legend>
      <a href="index.php">管理画面</a>
      <div>
        お名前: <input type="text" name="name" value="<?= $child_data[0]["name"] ?>">
      </div>
      <div>
        生年月日: <input type="date" name="birthday" value="<?= $child_data[0]["birthday"] ?>">
      </div>
      <div>
        身長: <input type="number" name="height" max="140" value="<?= $child_data[0]["height"] ?>" step="1">
      </div>
      <div>
        体重: <input type="number" name="weight" max="30.0" value="<?= $child_data[0]["weight"] ?>" step="0.1">
      </div>
      <div>
        画像: <input type="file" name="img" value="<?= $child_data[0]["img"] ?>"accept=".jpg,.jpeg,.png">
      </div> 
	  <div>
      <input type="hidden" name="child_id" value="<?= $child_data[0]["child_id"] ?>">
    </div>
      <div>
        <button type="submit">更新</button>
      </div>
      <a href="childpage.php">管理ページ</a>
      <a href="logout.php">logout</a>
    </fieldset>
  </form>

</body>

</html>