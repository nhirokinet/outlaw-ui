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
<h2>Sign Up</h2>
<?php if ($message !== NULL) { ?>
<div class="error_message"><?php disp($message); ?></div>
<?php } ?>	
<form method="POST">
Username: <input type="text" name="screen_name" value="<?php disp($screenname); ?>" /><br/>
E-mail address: <input type="text" name="email" value="<?php disp($email); ?>" /><br />
Just write "None" if you do not wish to provide it.
<br/>
Password: <input type="password" name="password" /><br/>
Password (confirmation): <input type="password" name="password_confirm" /><br/>

<br>
By signing up, you confirm that you agree with the <a href="./rules.php">Terms &amp; Rules</a>.
<br>
<input type="submit" value="Sign up" />
</form>
<?php
require_once('./parts/footer.php');
