<?php
require_once('./lib/lib.php');
require_once('./parts/header.php');

$my_submissions=get_user_submissions();

?>
<h2>にろきプロコン#1</h2>
<?php if ($user !== null) { ?>
コンテスト開始時刻以降に、上のメニューから「Problems」をクリックすると問題一覧を見ることができます。<br />
様々な都合上、通常の競技プログラミングと異なる点が多いので、事前に<a href="./rules.php">競技規約</a>を通読いただけますよう、お願い致します。<br />
<?php } else { ?>	
参加するためには<a href="./signup.php">ユーザー登録</a>する必要があります。<br />
既に登録している場合は<a href="./login.php">ログイン</a>してください。<br />
様々な都合上、通常の競技プログラミングと異なる点が多いので、事前に<a href="./rules.php">競技規約</a>を通読いただけますよう、お願い致します。<br />
<?php } ?>
<?php
require_once('./parts/footer.php');
