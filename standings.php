<?php
require_once('./lib/lib.php');
require_once('./parts/header.php');

$error_message = '';

?>
<h2>Standings</h2>
<table>
<tr>
<th>Rank</th>
<th>User</th>
<th>Score</th>
<th>Penalty</th>
<th>Miss Count</th>
</tr>
<?php
$problems = get_standings();

$cur_rank = 0;
$real_rank = $cur_rank;
$prev_score = -1;
$prev_penalty = -1;

foreach ($problems as $p) {
	++$cur_rank;

	if($prev_score != $p['score'] || ($prev_score == $p['score'] && $prev_penalty < $p['penalty'])) {
		$real_rank = $cur_rank;
	}

	$prev_score = $p['score'];
	$prev_penalty = $p['penalty'];
	?>
	<tr>
	<td style="text-align:right"><?php disp($real_rank); ?></td>
	<td><?php disp($p['screen_name']); ?></td>
	<td style="text-align:right"><?php disp($p['score']); ?></td>
	<td style="text-align:right"><?php disp(floor($p['penalty'] / 3600));?>:<?php disp(sprintf('%02d', (floor($p['penalty'] / 60))%60));?>'<?php disp(sprintf('%02d', floor($p['penalty'] % 60)));?>&quot;</td>
	<td style="text-align:right"><?php disp($p['miss_count']);?></td>
	</tr>
	<?php

}
?>
</table>
<?php
require_once('./parts/footer.php');
