<?php
require_once('./lib/lib.php');
require_once('./parts/header.php');

$my_submissions=get_user_submissions();

?>
<h2>Judge System for Competitive Programming</h2>
<?php if ($user !== null) { ?>
Logged in.
<?php } else { ?>	
You need to <a href="./signup.php">sign up</a>.<br />
If you have already signed up, <a href="./login.php">sign in</a>.<br />
<?php } ?>
<?php
require_once('./parts/footer.php');
