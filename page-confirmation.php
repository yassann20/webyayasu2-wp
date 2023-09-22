<?php get_header(); ?>

<?php

require "function.php";
//*$errorが真の場合は再入力画面を表示
$error = false;


$error = postcheck($_POST["nam"]);
if ($error == true) {
    $_SESSION["nam"] = "";
} else {
    $_SESSION["nam"] = htmlspecialchars($_POST["nam"]);
}

$error = postcheck($_POST["kana"]);
if ($error == true) {
    $_SESSION["kana"] = "";
} else {
    $_SESSION["kana"] = htmlspecialchars($_POST["kana"]);
}

$error = postcheck($_POST["mail"]);
if ($error == true) {
    $_SESSION["mail"] = "";
} else {
    $_SESSION["mail"] = htmlspecialchars($_POST["mail"]);
}

if ($_POST["text"] == "") {
    $_SESSION["text"] = "なし";
} else {
    $_SESSION["text"] = htmlspecialchars($_POST["text"]);
}


//IPアドレス取得
$_SESSION["IP"] = $_SERVER["REMOTE_ADDR"];

?>

<?php
    if ($error == true) :
    ?>
    <main>
        <div id=Content>
    <div id="Contact">
      <h2>入力に誤りがあります。</h2>
      <form action="<?php echo home_url('/confirmation/'); ?>" class="top-border-none" method="post">
        <label for="">
            <h3>氏名</h3>
            <?php if ($_SESSION["nam"] == "") : ?>
                <p>入力に誤りがあります。</p>
                <input name="nam" type="text">
            <?php else : ?>
                <p><?php echo $_SESSION["nam"]; ?></p>
            <?php endif; ?>
        </label>
        <label for="">
          <h3>氏名(ふりがな)</h3>
          <?php if ($_SESSION["kana"] == "") : ?>
                <p>入力に誤りがあります。</p>
                <input name="kana" type="text">
            <?php else : ?>
                <p><?php echo $_SESSION["kana"]; ?></p>
            <?php endif; ?>
        </label>
        <label for="">
          <h3>メールアドレス</h3>
          <?php if ($_SESSION["mail"] == "") : ?>
                <p>入力に誤りがあります。</p>
                <input name="mail" type="email">
            <?php else : ?>
                <p><?php echo $_SESSION["mail"]; ?></p>
            <?php endif; ?>
        </label>
        <label for="">
          <h3>内容</h3>
          <?php if ($_SESSION["text"] == "") : ?>
                    <p>なし</p>
                <?php else : ?>
                    <p><?php echo $SESSION["text"]; ?></p>
                <?php endif; ?>
        </label>
        <button type="submit" name="submit">送信</button>
      </form>
      <p id="Contact-alt">※ いたずら防止のためIPアドレスの保存をしております、ご容赦ください</p>
    </div>
                </div>
                </main>
    <?php else: ?>

<main>
        <div id="Content">
            <div id="Contact">
                <h2>お問い合わせ</h2>
                <form action="<?php echo home_url('/semdmail/'); ?>" class="top-border-none" method="post">
                    <label for="">
                        <h3>氏名</h3>
                        <p><?php echo $_SESSION["nam"]; ?></p>
                    </label>
                    <label for="">
                        <h3>氏名(ふりがな)</h3>
                        <p><?php echo $_SESSION["kana"]; ?></p>
                    </label>
                    <label for="">
                        <h3>メールアドレス</h3>
                        <p><?php echo $_SESSION["mail"]; ?></p>
                    </label>
                    <label for="">
                        <h3>内容</h3>
                        <p><?php echo $_SESSION["text"]; ?></p>
                    </label>
                    <button type="submit" name="submit">送信</button>
                </form>
                <p id="Contact-alt">※ いたずら防止のためIPアドレスの保存をしております、ご容赦ください</p>
            </div>
        </div>  
    </main>

    <?php endif; ?>

<?php get_footer(); ?>