<?php
require_once('./php/_funcs.php');
$pdo = connectDb();

// $stmt = $pdo->prepare("INSERT INTO userdata_table(id, name, furigana, email, music_category, subscribe_mail, date) VALUES(NULL, :name, :furigana, :email, :music_category, :subscribe_mail, now())");
$stmt = $pdo->prepare("SELECT * FROM userdata_table");

// $stmt->bindValue(':name', $name, PDO::PARAM_STR);
// $stmt->bindValue(':furigana', $furigana, PDO::PARAM_STR);
// $stmt->bindValue(':email', $email, PDO::PARAM_STR);
// $stmt->bindValue(':categories', $categories, PDO::PARAM_STR);
// $stmt->bindValue(':subscribe_mail', $subscribeMail, PDO::PARAM_STR);

$status = $stmt->execute();
if ($status == false) {
  $error = $stmt->errorInfo();
  exit('sqlError:' . $error[2]);
}else {
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  echo '<pre>';
  print_r($result); // デバッグ用に出力
  echo '</pre>';
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>サイトトップ</title>
  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body id="top">
  <div class="top__wrapper">
    <div class="subscribe-banner__container">
      <div class="subscribe-banner__contents">
        <a href="./php/form.php">ユーザー登録</a>
      </div>
    </div>

  </div>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="./js/index.js"></script>
</body>

</html>