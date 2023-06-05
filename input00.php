<?php

// セッションの開始
session_start();
// データ受け取り
include("functions.php");
check_session_id();




?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>子供情報登録画面</title>
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
    input[type="number"] {
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
  <form action="create00.php" method="POST" enctype="multipart/form-data">
    <fieldset>
      <legend>子供情報登録</legend>
      <a href="index.php">管理画面</a>
      <div>
        お名前: <input type="text" name="name">
      </div>
      <div>
        生年月日: <input type="date" name="birthday">
      </div>
      <div>
        身長: <input type="number" name="height" max="140" value="80" step="1">
      </div>
      <div>
        体重: <input type="number" name="weight" max="30.0" value="2.0" step="0.1">
      </div>
      <div>
        <button type="submit">入力</button>
      </div>
      <a href="logout.php">logout</a>
    </fieldset>
  </form>

</body>

</html>

<!-- <!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>子供情報登録画面</title>
</head>

<body>
  <form action="create00.php" method="POST" enctype="multipart/form-data">
    <fieldset>
      <legend>子供情報登録
      </legend>
      <a href="index.php">管理画面</a>
	  <div>
        お名前: <input type="text" name="name">      
      </div>
	  <div>
        生年月日: <input type="date" name="birthday">      
      </div>
      <div>
        身長: <input type="number" name="height" max="140" value="80" step="1">      
      </div>
	  <div>
        体重: <input type="number" name="weight" max="30.0" value="2.0" step="0.1">      
      </div>
    
       <div>
        画像: <input type="file" name="img" accept=".jpg,.jpeg,.png" required>
      </div> 
      <div>
        <button>入力</button>
      </div>
      <a href="logout.php">logout</a>
    </fieldset>
  </form>

</body>

</html> -->