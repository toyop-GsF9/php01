<?php
session_start();
include('functions.php');
check_session_id();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>子供服入力画面</title>
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
  <form action="create01.php" method="POST" enctype="multipart/form-data">
    <fieldset>
      <legend>子供服入力</legend>
      
      <div>
        サイズ: <input type="text" name="size" list="size">      
      </div>
      <datalist id="size">
        <option value="90"></option>
        <option value="100"></option>
        <option value="110"></option>
        <option value="120"></option>
        <option value="130"></option>
      </datalist>
    
      <div>
        メーカー: <input type="text" name="maker" list="maker">
      </div>
      <datalist id="maker">
        <option value="UNIQLO"></option>
        <option value="GU"></option>
        <option value="GAP"></option>
        <option value="西松屋"></option>
        <option value="無印良品"></option>
        <option value="その他"></option>
      </datalist>
      <div>
        服の種類: <input type="text" name="type" list="type">
      </div>
      <datalist id="type">
        <option value="Tシャツ"></option>
        <option value="ロンT"></option>
        <option value="半ズボン"></option>
        <option value="長ズボン"></option>
        <option value="トレーナー"></option>
        <option value="肌着(ランニング）"></option>
        <option value="肌着（半袖）"></option>
        <option value="肌着（長袖）"></option>
        <option value="遊び着"></option>
        <option value="パジャマ"></option>
        <option value="その他"></option>
      </datalist>

      <div>
        購入時期:<input type="month" name="date" min="2021-02" max="2043-12" value="2021-02">
      </div>
      <div>
        画像: <input type="file" name="img" accept=".jpg,.jpeg,.png" required>
      </div>
      <div>
        <button>入力</button>
      </div>

      <a href="childpage.php">管理ページ</a>
    </fieldset>
  </form>

</body>

</html>


