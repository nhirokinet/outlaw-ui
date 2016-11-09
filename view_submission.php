<?php
require_once('./lib/lib.php');
require_once('./parts/header.php');
?>
<?php
$my_submissions=get_user_submissions();
?>
<link rel="stylesheet" href="./vendor/highlight/styles/default.css">
<script src="./vendor/highlight/highlight.pack.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
<?php
$target_id = (int) $_GET['id'];
$flag = false;
foreach ($my_submissions as $submit) {
	if ($submit['id'] == $target_id) {
		$flag = true;
?>
<h2>Submission Detail</h2>
<table>
<tr>
<tr><th>Submission ID</th><td><?php disp($submit['id']); ?></td></tr>
<tr><th>Problem</th><td><a href="./problem.php?problem_id=<?php disp($submit['problem_id']); ?>"><?php disp($submit['problem_title']); ?></a></td></tr>
<tr><th>Language</th><td><?php disp($languages_dict[$submit['language']]); ?></td></tr>
<tr><th>Judge Status</th><td><?php disp($submit['judge_status']); ?></td></tr>
<tr><th>Execution Time</th><td><?php disp($submit['execution_time']); ?> ms</td></tr>
<tr><th>Submitted At</th><td><?php disp($submit['created_at']); ?></td></tr>

</table>
<h2>Compile Message</h2>
<pre class="source"><?php disp($submit['error_message']); ?></pre>
<h2>Source Code</h2>
<pre class="<?php disp(choose_highlighter_class_name($submit['language'])); ?>"><code><?php disp($submit['source_code']); ?></code></pre>
<?php
	}
}
?>
<?php
if ($flag === false) {
	echo 'error';
}

require_once('./parts/footer.php');
