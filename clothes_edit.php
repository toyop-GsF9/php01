<?php
session_start();

include("functions.php");
check_session_id();

$user_id = $_SESSION['user_id'];
$clothes_id = $_GET['clothes_id'];


$pdo = connect_to_db();

// 子供データ用
$sql = 'SELECT * FROM `PHP_SSK_clothes` WHERE user_id=:user_id AND clothes_id=:clothes_id';

$cl_stmt = $pdo->prepare($sql);

$cl_stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$cl_stmt->bindValue(':clothes_id', $clothes_id, PDO::PARAM_INT);

try {
  $status = $cl_stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$clothes_data= $cl_stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>服情報更新画面</title>
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

    div {
      margin-bottom: 20px;
    }

    input[type="text"],
    input[type="month"],
    input[type="file"] {
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

    a {
      display: block;
      margin-top: 10px;
      color: #333;
      text-decoration: none;
      font-size: 16px;
    }

    a:hover {
      color: #ff6f00;
    }
  </style>
</head>

<body>
  <form action="clothes_update.php" method="POST" enctype="multipart/form-data">
    
    <fieldset>
      <legend>服情報更新</legend>
      <!-- <a href="index.php">管理画面</a> -->
      <div>
        サイズ: <input type="text" name="size" list="size" value="<?= $clothes_data[0]["size"] ?>">
      </div>
	  	<datalist id="size">
 		 <?php foreach (["90", "100", "110", "120", "130"] as $option): ?>
    	<option value="<?= $option ?>" <?= ($clothes_data[0]["size"] == $option) ? "selected" : "" ?>></option>
  		<?php endforeach; ?>
		</datalist>
      <div>
        メーカー: <input type="text" name="maker" list="maker" value="<?= $clothes_data[0]["maker"] ?>">
      </div>
	  <datalist id="maker">
 		 <?php foreach (["UNIQLO", "GU", "GAP", "西松屋", "無印良品","その他"] as $option): ?>
    	<option value="<?= $option ?>" <?= ($clothes_data[0]["maker"] == $option) ? "selected" : "" ?>></option>
  		<?php endforeach; ?>
		</datalist>
      <div>
        服の種類: <input type="text" name="type" list="type" value="<?= $clothes_data[0]["type"] ?>">
      </div>
	    <datalist id="maker">
 		 <?php foreach (["Tシャツ", "ロンT", "半ズボン", "長ズボン", "トレーナー","肌着(ランニング）", "肌着（半袖）", "肌着（長袖）", "遊び着", "パジャマ","その他"] as $option): ?>
    	<option value="<?= $option ?>" <?= ($clothes_data[0]["type"] == $option) ? "selected" : "" ?>></option>
  		<?php endforeach; ?>
		</datalist>
      <div>
        購入時期: <input type="month" name="date" min="2021-02" max="2043-12" value="<?= $clothes_data[0]["date"] ?>" step="0.1">
      </div>
      <div>
        画像: <input type="file" name="img" value="<?= $clothes_data[0]["img"] ?>"accept=".jpg,.jpeg,.png">
      </div> 
	  <div>
      <input type="hidden" name="clothes_id" value="<?= $clothes_data[0]["clothes_id"] ?>">
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