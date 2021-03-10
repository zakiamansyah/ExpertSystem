<?php
include '../../../inc/inc.koneksi.php';
$id = $_GET['id'];
$sql = mysql_query("DELETE FROM rusak WHERE id_rusak='$id'");

?>
