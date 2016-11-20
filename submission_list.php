<?php
require_once('./lib/lib.php');
require_once('./parts/header.php');

if ($user === null) {
	echo 'You must login.';
	require('./parts/footer.php');
	exit(0);
}

$my_submissions=get_user_submissions();

?>
<h2>Your submissions</h2>
<table>
<tr>
<th>ID</th>
<th>Problem</th>
<th>Language</th>
<th>Judge Status</th>
<th>Execution Time</th>
<th>Memory</th>
<th>Submitted At</th>
</tr>
<?php
foreach ($my_submissions as $submit) {
?>
<tr>
<td><a href="./view_submission.php?id=<?php disp($submit['id']); ?>"><?php disp($submit['id']); ?></a></td>
<td><a href="./problem.php?problem_id=<?php disp($submit['problem_id']); ?>"><?php disp($submit['problem_title']); ?></a></td>
<td><?php disp($languages_dict[$submit['language']]); ?></td>
<td class="<?php disp($submit['judge_status'] === 'accepted' ? 'td_judge_accept' : (($submit['judge_status'] === 'judging' || $submit['judge_status'] === 'waiting') ? '' : 'td_judge_fail')); ?>">
	<?php echo(get_status_html($submit['judge_status'])); ?>
</td>
<?php if ($submit['judge_status'] === 'waiting' || $submit['judge_status'] === 'judging' || $submit['judge_status'] === 'build_fail') { ?>
<td style="text-align:right; padding-left: 10px; padding-right: 10px;">&nbsp;</td>
<td style="text-align:right; padding-left: 10px; padding-right: 10px;">&nbsp;</td>
<?php } else { ?>
<td style="text-align:right; padding-left: 10px; padding-right: 10px;"><?php disp(number_format($submit['execution_time'])); ?> ms</td>
<td style="text-align:right; padding-left: 10px; padding-right: 10px;"><?php disp(((int)($submit['memory_used_in_kb']) < 0)?'Unknown':number_format($submit['memory_used_in_kb']) . ' kB'); ?></td>
<?php } ?>
<td style="text-align:right; padding-left: 10px; padding-right: 10px;"><?php disp($submit['created_at']); ?></td>
</tr>
<?php } ?>
</table>
<br />
<?php
require_once('./parts/footer.php');
