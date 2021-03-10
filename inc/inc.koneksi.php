<?php
$db['host'] = "localhost";
$db['user'] = "root";
$db['pass'] = "";
$db['database'] = "rusak";

$con = mysql_connect($db['host'],$db['user'],$db['pass']);
if (!$con) {
  echo "Gagal koneksi!";
  mysql_error();
}
mysql_select_db($db['database']) or die ("Database Not Found ".mysql_error());

$konfig['url'] = "http://localhost/ano/rusak/";
$konfig['judul'] = "Penentuan Kerusakan Program POS (Point Of Sales) Dengan Pendekatan Sistem Pakar";

?>
