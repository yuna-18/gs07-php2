<?php
require_once('./_funcs.php');
session_start();

// var_dump($_SESSION);
$name = $_SESSION['name'];
$furigana = $_SESSION['furigana'];
$email = $_SESSION['email'];
$categories_str = isset($_SESSION['categories']) && is_array($_SESSION['categories'])
    ? implode(', ', $_SESSION['categories'])
    : '';
$subscribeMail = $_SESSION['subscribe_mail'];
// var_dump($categories_str);

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
        $stmt = $pdo->prepare("INSERT INTO userdata_table(name, furigana, email, music_category, subscribe_mail, date) VALUES(:name, :furigana, :email, :music_category, :subscribe_mail, now())");
        if (!$stmt) {
            exit('Database connection failed');
        }

        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':furigana', $furigana, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':music_category', $categories_str, PDO::PARAM_STR);
        $stmt->bindValue(':subscribe_mail', $subscribeMail, PDO::PARAM_INT);

        $status = $stmt->execute();
        if ($status == false) {
          $error = $stmt->errorInfo();
          var_dump($error);
          session_destroy();
          exit('sqlError:' . $error[2]);
        } else {
        ?>
          <p>以下の内容で登録しました。</p>
          <div class="confirm__outer">
            <p class="confirm__label">氏名</p>
            <p class="confirm__content"><?= $name ?></p>
          </div>
          <div class="confirm__outer">
            <p class="confirm__label">フリガナ</p>
            <p class="confirm__content"><?= $furigana ?></p>
          </div>
          <div class="confirm__outer">
            <p class="confirm__label">メール</p>
            <p class="confirm__content"><?= $email ?></p>
          </div>
          <div class="confirm__outer">
            <p class="confirm__label">好きな音楽のカテゴリ</p>
            <ul class="confirm__content--list">
              <?php
              foreach ($_SESSION['categories'] as $category) {
                echo '<li class="confirm__content">' . $category . '</li>';
              }
              ?>
            </ul>
          </div>
          <div class="confirm__outer">
            <p class="confirm__label">メールで演奏会の通知を受け取る</p>
            <p class="confirm__content">
            <?php
            if ($subscribeMail === 1) {
              echo "受け取る";
            } else {
              echo "受け取らない";
            }
            ?>
            </p>
          </div>
        <?php
          session_destroy();
        }
        ?>
      </div>
    </div>
    <a href="../index.php" class="totop-btn btn">TOPへ戻る</a>
  </div>
</body>

</html>