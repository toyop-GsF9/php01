<?php
// セッションの開始
session_start();
// データ受け取り
include("functions.php");
check_session_id();
$pdo = connect_to_db();

$user_id = $_SESSION['user_id'];

// 子供データ用
$sql = 'SELECT * FROM PHP_SSK_child WHERE user_id =:user_id ';

$child_stmt = $pdo->prepare($sql);

$child_stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
try {
  $status = $child_stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
$child_data= $child_stmt->fetchALL(PDO::FETCH_ASSOC);

//   $_SESSION['child_id'] = $child_data['child_id'];
//   var_dump($child_data[0]["child_id"]);
//   exit();

// 子供服データ用
$cl_sql = 'SELECT * FROM PHP_SSK_clothes WHERE user_id =:user_id ';

$cl_stmt = $pdo->prepare($cl_sql);

$cl_stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
try {
  $status = $cl_stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
$clothes_data = $cl_stmt->fetchAll(PDO::FETCH_ASSOC);

// 並び替え機能

$sortColumn = 'size'; // デフォルトの並び替え対象カラム（サイズ）

if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
    if ($sort === 'maker' || $sort === 'type' || $sort === 'date') {
        $sortColumn = $sort;
    }
}

// データの並び替え
usort($clothes_data, function ($a, $b) use ($sortColumn) {
    return $a[$sortColumn] <=> $b[$sortColumn];
});

?>



<!DOCTYPE html>
<html>
<head>
    <title>データ表示ページ</title>
  

    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        margin: 0;
        padding: 20px;
    }
    
    h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }
    
    .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        align-items: flex-start;
    }
    
    .child-item,
    .clothes-item {
        flex-basis: 33%;
        padding: 10px;
        box-sizing: border-box; /* 追加: ボックスサイズを要素の全体として指定 */
    }
    
    .child-item p {
        margin: 0; /* 追加: 段落のマージンをリセット */
        line-height: 1.5; /* 追加: 行の高さを指定 */
    }
    
    .child-image,
    .clothes-image {
        max-width: 100%;
        height: 300px; /* 高さを統一する値に指定 */
        object-fit: cover;
        margin-right: 10px;
    }
    
    select {
        margin-bottom: 10px;
        padding: 5px;
        font-size: 16px;
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
    <h2>子供画面</h2>
    <div class="container">
        <?php foreach ($child_data as $children) : ?>
        <!-- PHP_SSK_childテーブルのデータ表示 -->
        <div class="child-item">
             <a href="child_edit.php?child_id=<?php echo $children['child_id']; ?>">
            <img class="child-image" src="<?php echo $children['img']; ?>" alt="Child Image">
            <!-- <div class="child-image" style="background-image: url('<?php echo $children['img']; ?>');"></div> -->
            <p>名前<?php echo ' '.$children['name']; ?></p>
            <p>誕生日<?php echo ' '.$children['birthday']; ?></p>
            <p>身長<?php echo ' '.$children['height']; ?></p>
            <p>体重<?php echo ' '.$children['weight']; ?></p>
           
        </div>
        <?php endforeach; ?>
    </div>

    <a href="input00.php">子供情報入力画面</a>
     <!-- <a href="child_edit.php">子供情報更新画面</a> -->
    <hr>
    
    <!-- PHP_SSK_clothesテーブルのデータ表示 -->
   
<h2>子供服画面</h2>

<!-- サイズ選択リストボックス -->
<select id="sizeSelect" onchange="filterClothes('size', this.value)">
    <option value="">サイズ</option>
    <?php 
        $sizes = array_unique(array_column($clothes_data, 'size'));
        foreach ($sizes as $option): ?>
        <option value="<?= $option ?>"><?= $option ?></option>
    <?php endforeach; ?>
</select>

<!-- メーカー選択リストボックス -->
<select id="makerSelect" onchange="filterClothes('maker', this.value)">
    <option value="">メーカー</option>
    <?php 
        $makers = array_unique(array_column($clothes_data, 'maker'));
        foreach ($makers as $option): ?>
        <option value="<?= $option ?>"><?= $option ?></option>
    <?php endforeach; ?>
</select>

<!-- 種類選択リストボックス -->
<select id="typeSelect" onchange="filterClothes('type', this.value)">
    <option value="">服の種類</option>
    <?php 
        $types = array_unique(array_column($clothes_data, 'type'));
        foreach ($types as $option): ?>
        <option value="<?= $option ?>"><?= $option ?></option>
    <?php endforeach; ?>
</select>


<!-- 全データ再表示ボタン -->
<button onclick="location.href=window.location.pathname">全データ表示</button>
<br>
<!-- 既存のソート機能リストボックス -->
<select onchange="sortClothes(this.value)">
    <option value="">並び替え</option>
    <option value="size">サイズ順</option>
    <option value="maker">メーカー順</option>
    <option value="type">服の種類順</option>
    <option value="date">購入時期順</option>
</select>
<script>
    function filterClothes(field, value) {
        var url = window.location.pathname + '?' + field + '=' + value;
        window.location.href = url;
    }

    function sortClothes(sort) {
        var url = window.location.pathname + '?sort=' + sort;
        window.location.href = url;
    }
</script>

<div class="container"> 
    <?php 
    // フィルタリングパラメータが存在すればフィルタリングを行う
    $sizeFilter = isset($_GET['size']) ? $_GET['size'] : null;
    $makerFilter = isset($_GET['maker']) ? $_GET['maker'] : null;
    $typeFilter = isset($_GET['type']) ? $_GET['type'] : null;

    foreach ($clothes_data as $clothes) :
       
        // 文字列として比較する
        if ($sizeFilter !== null && (string)$clothes['size'] !== (string)$sizeFilter) continue;
        if ($makerFilter !== null && (string)$clothes['maker'] !== (string)$makerFilter) continue;
        if ($typeFilter !== null && (string)$clothes['type'] !== (string)$typeFilter) continue;

    ?>
    <div class="clothes-item">
        <a href="clothes_edit.php?clothes_id=<?php echo $clothes['clothes_id']; ?>">
        <img class="clothes-image" src="<?php echo $clothes['img']; ?>" alt="Clothes Image">
        <p>サイズ<?php echo $clothes['size']; ?></p>
        <p>メーカー<?php echo $clothes['maker']; ?></p>
        <p>服の種類<?php echo $clothes['type']; ?></p>
        <p>購入時期<?php echo $clothes['date']; ?></p>
        <p><?php echo $clothes['column5']; ?></p>
        <p><?php echo $clothes['column6']; ?></p> 
    </div>
    <?php endforeach; ?>
</div>
<a href="input01.php">子供服入力画面</a>
<a href="logout.php">ログアウト</a>
</body>
</html>







