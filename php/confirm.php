<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー登録フォーム</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/style.css">
</head>

<body id="confirm">
  <div class="confirm__wrapper">
    <div class="confirm__container">
      <div class="confirm__contents">
        <div class="notation">
          <p>以下の内容で登録します。</p>
        </div>
        <div class="confirm__outer">
          <p class="confirm__label">氏名</p>
          <p class="confirm__content"><?= $_POST['name']; ?></p>
        </div>
        <div class="confirm__outer">
          <p class="confirm__label">フリガナ</p>
          <p class="confirm__content"><?= $_POST['furigana']; ?></p>
        </div>
        <div class="confirm__outer">
          <p class="confirm__label">メール</p>
          <p class="confirm__content"><?= $_POST['email']; ?></p>
        </div>
        <div class="confirm__outer">
          <p class="confirm__label">好きな音楽のカテゴリ</p>
          <?php
          if (!empty($_POST['categories'])) {
            echo '<ul class="confirm__content--list">';
            foreach ($_POST['categories'] as $category) {
              echo '<li class="confirm__content">' . htmlspecialchars($category, ENT_QUOTES, 'UTF-8') . '</li>';
            }
            echo '</ul>';
          } else {
            echo '<p class="confirm__content">選択されたカテゴリはありません。</p>';
          }
          ?>
        </div>
        <div class="confirm__outer">
          <p class="confirm__label">メールで演奏会の通知を受け取る</p>
          <p class="confirm__content">
            <?php
            if (!empty($_POST['subscribe-mail'])) {
              echo $_POST['subscribe-mail'];
              $subscribeMail = "受け取る";
            } else {
              echo "受け取らない";
              $subscribeMail = "受け取らない";
            }
            ?>
          </p>
        </div>
      </div>
    </div>
    <form action="./complete.php" method="post">
      <?php
      echo '<input type="hidden" name="name" id="name" value="' . htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8') . '">';
      echo '<input type="hidden" name="furigana" id="furigana" value="' . htmlspecialchars($_POST['furigana'], ENT_QUOTES, 'UTF-8') . '">';
      echo '<input type="hidden" name="email" id="email" value="' . htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') . '">';
      if (!empty($_POST['categories'])) {
        foreach ($_POST['categories'] as $category) {
          echo '<input type="hidden" name="categories[]" value="' . htmlspecialchars($category, ENT_QUOTES, 'UTF-8') . '">';
        }
      }
      echo '<input type="hidden" name="subscribe-mail" id="subscribe-mail" value="' . htmlspecialchars($subscribeMail, ENT_QUOTES, 'UTF-8') . '">';
      ?>
      <div class="btn__container">
        <a href="../index.php" class="back-btn btn">戻る</a>
        <input type="submit" class="submit-btn btn" value="送信">
      </div>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="../js/index.js"></script>
</body>

</html>