<?php
require_once('./lib/lib.php');
require_once('./parts/header.php');

$message = NULL;

if (array_key_exists('screen_name', $_POST)) {
	$screenname = $_POST['screen_name'];
	$email = $_POST['email'];

	$status = (signup($_POST['screen_name'], $_POST['password'], $_POST['email']));

	if ($status['status']=='success') {
		echo 'Registration succeeded! Now you can <a href="./login.php">login</a>.';
		require_once('./parts/footer.php');
		exit(0);
	} else {
		$message = $status['message'];
	}
}
?>
<h2>ユーザー登録</h2>
<?php if ($message !== NULL) { ?>
<div class="error_message"><?php disp($message); ?></div>
<?php } ?>	
<form method="POST">
Username: <input type="text" name="screen_name" value="<?php disp($screenname); ?>" /><br/>
メールアドレスまたはTwitterアカウント: <input type="text" name="email" value="<?php disp($email); ?>" /><br />
Twitterアカウントの場合は「@」で始めてください。どちらも書きたくない場合は「none」と記入してください。
<br/>
パスワード: <input type="password" name="password" /><br/>
パスワード（確認のため再入力）: <input type="password" name="password_confirm" /><br/>

<br>
登録すると<a href="./rules.php">競技規約</a>に同意したとみなされます。
<br>
<input type="submit" value="登録" />
</form>
<?php
require_once('./parts/footer.php');
