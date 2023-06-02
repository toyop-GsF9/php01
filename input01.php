<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>子供服入力画面</title>
</head>

<body>
  <form action="create01.php" method="POST" enctype="multipart/form-data">
    <fieldset>
      <legend>子供服入力
      </legend>
      
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

      <a href="index.php">管理画面に戻る</a>
    </fieldset>
  </form>

</body>

</html>