<?php
require_once('./lib/lib.php');
require_once('./parts/header.php');

?>
<h2>言語ごとの注意事項</h2>
<h3>Java</h3>
ソースコードは Main.java というファイル名としてコンパイルされ、 Main クラスが呼び出されます。

<h3>Scala</h3>
ソースコードは Main.scala というファイル名としてコンパイルされ、 Main クラスが呼び出されます。

<h3>Perl 6 (Rakudostar)</h3>
ご想像通り、実験版です。ご理解の上、ご使用ください。Ubuntu 16.04 で apt install rakudo で入るものが使用されます。

<h3>Piet (npiet, BASE64)</h3>
png のバイナリを BASE64 エンコードして送信してください。npiet （https://www.bertnase.de/npiet/ ）によって実行されます。

<?php
require_once('./parts/footer.php');
