<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>にろきプロコン#1</title>
<link rel="stylesheet" href="./css/main.css">
</head>
<body>
<header>
	<div id="title_logo">
		<h1>にろきプロコン#1</h1>
	</div>
	<div id="header_userinfo">
		<?php if ($user !== null) { ?>
		Hello,  <?php disp($user['screen_name']); ?>
		<form action = "./logout.php" method="POST">
		<input type="hidden" name="write_check" value="<?php disp(post_signiture()); ?>" />
		<input type="submit" value="Log out" />
		</form>
		<?php } else { ?>
		New user?  <a href="./login.php">login</a> or 
		<a href="./signup.php">sign up</a>
		<?php } ?>
	</div>
	<div class="clear">&nbsp;</div>
</header>
<div id="headmenu">
	<a href="./">Top</a>
	<a href="./problem_list.php">Problems</a>
	<a href="./submission_list.php">My Submissions</a>
	<a href="./standings.php">Standings</a>
	<a href="./broadcast.php">Notifications</a>
</div>
<div id="main">
