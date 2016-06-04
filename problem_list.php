<?php
require_once('./lib/lib.php');
require_once('./parts/header.php');

$error_message = '';

$problems = get_problems();
if (array_key_exists('status', $problems) && $problems['status'] === 'error') {
	disp($problems['message']);
	require_once('./parts/footer.php');
	exit;
}

?>
<h2>Problems</h2>
<table>
<?php

foreach ($problems as $p) {
	?>
	<tr <?php if($p['accepted_judge']==1){echo 'class="accepted_problem"';} ?>>
	<th style="text-align: left"><a href="./problem.php?problem_id=<?php disp($p['id']); ?>"><?php disp($p['title']); ?></a></th>
	<td style="text-align: right"><?php disp($p['point']); ?> pts</td>
	</tr>
	<?php

}
?>
</table>
</body>
<?php
require_once('./parts/footer.php');
?>
