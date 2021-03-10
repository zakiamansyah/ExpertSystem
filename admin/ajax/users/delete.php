<?php
include '../../../inc/inc.koneksi.php';
$id = $_GET['id'];
$sql = mysql_query("DELETE FROM user WHERE id='$id'");

?>
