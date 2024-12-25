<?php
require_once('./_funcs.php');
session_start();

$name = $_SESSION['name'];
$furigana = $_SESSION['furigana'];
$email = $_SESSION['email'];
$categories = $_SESSION['categories'];
$subscribeMail = $_SESSION['subscribe-mail'];

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>登録完了</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/style.css">
</head>

<body id="complete">
  <div class="complete__wrapper">
    <div class="complete__container">
      <div class="complete__contents">
        <?php
        $pdo = connectDb();
        $stmt = $pdo->prepare("INSERT INTO userdata_table(id, name, furigana, email, music_category, subscribe_mail, date) VALUES(NULL, :name, :furigana, :email, :music_category, :subscribe_mail, now())");

        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':furigana', $furigana, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':categories', $categories, PDO::PARAM_STR);
        $stmt->bindValue(':subscribe_mail', $subscribeMail, PDO::PARAM_STR);

        $status = $stmt->execute();
        if ($status == false) {
          $error = $stmt->errorInfo();
          exit('sqlError:' . $error[2]);
        } else {
        ?>
          <p>以下の内容で登録しました。</p>
          <div class="confirm__outer">
            <p class="confirm__label">氏名</p>
            <p class="confirm__content"><?= ' . htmlSpChar($name) . ' ?></p>
          </div>
          <div class="confirm__outer">
            <p class="confirm__label">フリガナ</p>
            <p class="confirm__content"><?= ' . htmlSpChar($furigana) . ' ?></p>
          </div>
          <div class="confirm__outer">
            <p class="confirm__label">メール</p>
            <p class="confirm__content"><?= ' . htmlSpChar($email) . ' ?></p>
          </div>
          <div class="confirm__outer">
            <p class="confirm__label">好きな音楽のカテゴリ</p>
            <ul class="confirm__content--list">
              <?php
              foreach ($categories as $category) {
                echo '<li class="confirm__content">' . htmlSpChar($category) . '</li>';
              }
              ?>
            </ul>
          </div>
          <div class="confirm__outer">
            <p class="confirm__label">メールで演奏会の通知を受け取る</p>
            <p class="confirm__content"><?= ' . htmlSpChar($subscribeMail) . ' ?></p>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <a href="../index.php" class="totop-btn btn">TOPへ戻る</a>
</body>

</html>