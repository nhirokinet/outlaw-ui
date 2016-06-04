<?php
require_once('./lib/lib.php');

$user = whoami();
?>
<!doctype html>
<html>
<head>
<title>Cocytus</title>
</head>
<body>
<h1>Cocytus</h1>
<?php if ($user !== null) { ?>
<h2>Submissions</h2>

<?php
$submissions = get_user_submissions();
?>
<table border="1">
<tr>
<th>submission id</th><th>problem_id</th><th>language</th><th>status</th><th>execution time</th><th>submission time</th>
</tr>
<?php foreach ($submissions as $submission) { ?>
<tr><td><?php var_dump ($submission); ?></td></tr>

<?php } ?>
</table>

<?php } else { ?>
New user?  <a href="./login.php">login</a>
<?php } ?>
<br />
</body>
</html>
