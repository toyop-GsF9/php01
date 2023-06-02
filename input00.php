<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>子供情報登録画面</title>
</head>

<body>
  <form action="create.php" method="POST" enctype="multipart/form-data">
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
    </fieldset>
  </form>

</body>

</html>