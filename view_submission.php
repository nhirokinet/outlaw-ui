<?php
require_once('./lib/lib.php');
require_once('./parts/header.php');
?>
<?php
$my_submissions=get_user_submissions();
?>
<script type="text/javascript" src="./vendor/syntaxhighlighter_3.0.83/scripts/shCore.js"></script>
<script type="text/javascript" src="./vendor/syntaxhighlighter_3.0.83/scripts/shBrushCpp.js"></script>
<script type="text/javascript" src="./vendor/syntaxhighlighter_3.0.83/scripts/shBrushJava.js"></script>
<script type="text/javascript" src="./vendor/syntaxhighlighter_3.0.83/scripts/shBrushScala.js"></script>
<script type="text/javascript" src="./vendor/syntaxhighlighter_3.0.83/scripts/shBrushPerl.js"></script>
<script type="text/javascript" src="./vendor/syntaxhighlighter_3.0.83/scripts/shBrushPhp.js"></script>
<script type="text/javascript" src="./vendor/syntaxhighlighter_3.0.83/scripts/shBrushPython.js"></script>
<script type="text/javascript" src="./vendor/syntaxhighlighter_3.0.83/scripts/shBrushRuby.js"></script>

<link rel="stylesheet" type="text/css" href="./vendor/syntaxhighlighter_3.0.83/styles/shCore.css" />
<link rel="stylesheet" type="text/css" href="./vendor/syntaxhighlighter_3.0.83/styles/shThemeDefault.css" />

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
<tr><th>Execution Time</th><td><?php disp(number_format($submit['execution_time'])); ?> ms</td></tr>
<tr><th>Memory Usage</th><td><?php disp(((int)($submit['memory_used_in_kb']) < 0)?'Unknown':number_format($submit['memory_used_in_kb']) . ' kB'); ?></td></tr>
<tr><th>Submitted At</th><td><?php disp($submit['created_at']); ?></td></tr>

</table>
<h2>Compile Message</h2>
<pre class="source"><?php disp($submit['error_message']); ?></pre>
<h2>Source Code</h2>
<pre class="brush: <?php disp(choose_highlighter_class_name($submit['language'])); ?>"><?php disp($submit['source_code']); ?></pre>
<script type="text/javascript">
	SyntaxHighlighter.all();
</script>
<?php
	}
}
?>
<?php
if ($flag === false) {
	echo 'error';
}

require_once('./parts/footer.php');
