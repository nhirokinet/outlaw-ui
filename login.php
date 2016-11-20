<?php
require_once('./lib/lib.php');
require_once('./parts/header.php');

$screenname = '';

$message = NULL;

if (array_key_exists('screen_name', $_POST)) {
	if (array_key_exists('password', $_POST)) {
		$sess = (login($_POST['screen_name'], $_POST['password']));

		if ($sess['status'] === 'success') {
			set_session_id($sess['session_id']);
			header ('Location: ./');
		}
		// if succeed, redirect.
		// else, hold error message and username.
	}

	$message = 'Login incorrect';

	$screenname = $_POST['screen_name'];
}
?>
<h2>Log in</h2>
<?php if ($message !== NULL) { ?>
<div class="error_message"><?php disp($message); ?></div>
<?php } ?>	
<form method="POST">
Username: <input type="text" name="screen_name" value="<?php disp($screenname); ?>" /><br/>
Password: <input type="password" name="password" /><br/>
<input type="submit" value="Login" />
</form>
<?php
require_once('./parts/footer.php');
