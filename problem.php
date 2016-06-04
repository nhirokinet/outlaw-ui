<?php
require_once('./lib/lib.php');
require_once('./parts/header.php');

$error_message = '';

?>
<?php if ($user === null) { ?>
You must login.
<?php
require_once('./parts/footer.php');
exit(0); ?>
<?php } ?>
<?php if (! array_key_exists('problem_id', $_GET)) { ?>
Error: invalid URL.
<?php
require_once('./parts/footer.php');
exit(0); ?>
<?php } ?>
<?php
$problem = get_problem($_GET['problem_id']);

if (array_key_exists('status', $problem) && $problem['status'] === 'error') {
	disp($problem['message']);
	require_once('./parts/footer.php');
	exit;
}

?>
<h2><?php disp($problem['title']); ?></h2>
<?php echo $problem['problem_html']; ?>
<br />
<a href="./submission.php?problem_id=<?php disp(urlencode($problem['id'])); ?>">Submit</a>
<?php
require_once('./parts/footer.php');
