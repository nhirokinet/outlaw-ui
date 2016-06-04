<?php
require_once('./lib/lib.php');
require_once('./parts/header.php');

if ($user === null) {
	echo 'You must login.';
	require('./parts/footer.php');
	exit(0);
}

$error_message = null;

if (! array_key_exists('problem_id', $_GET)) {
	echo 'Error: invalid URL.';
	require('./parts/footer.php');
	exit(0);
}

$prevlang='';

if (array_key_exists('write_check', $_POST)) {
	if ($_POST['write_check'] === post_signiture()) {
		$prevlang = $_POST['language'];

		if ($error_message === null) {
			$status = submit_code($_POST['problem_id'], $_POST['language'], $_POST['code_to_submit']);

			if ($status['status'] !== 'success') {
				$error_message .= $status['message'] . "\n";
			} else {
				header('Location: ./submission_list.php');
			}
		}

	} else {
		exit(0);
	}
}

$problem = get_problem($_GET['problem_id']);
?>

<h2>Submission</h2>
<h3><?php disp($problem['title']); ?></h3>
<?php

if ($error_message!==null) {
	echo '<h2>Error</h2>';
	echo '<div class="error_message">';
	disp_multilines($error_message);
	echo '</div>';
}
?>
<form method="POST">
<input type="hidden" name="write_check" value="<?php echo post_signiture(); ?>" />
<input type="hidden" name="problem_id" value="<?php disp($_GET['problem_id']); ?>" />
Language: <select name="language">
<option value="">Select Language</option>
<?php
for ($i=0; $i<count($languages_raw); ++$i) {
?>
	<option value="<?php disp($languages_raw[$i]);?>" <?php if($prevlang==$languages_raw[$i])echo('selected="selected"');?>><?php disp($languages_disp[$i]); ?></option>
<?php
}
?>
</select><br />
<textarea name="code_to_submit" rows="25" cols="80"><?php if (array_key_exists('code_to_submit', $_POST)) {disp($_POST['code_to_submit']);} ?></textarea><br />
<input type="submit" value="Send" />
</form>
<br />
<?php
require_once('./parts/footer.php');
