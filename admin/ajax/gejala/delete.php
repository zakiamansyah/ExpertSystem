<?php
include '../../../inc/inc.koneksi.php';
$id = $_GET['id'];
$sql = mysql_query("DELETE FROM gejala WHERE id_gejala='$id'");
if ($sql) {
      	header("Content-Type: application/json");
    echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
  } else {
  	header("Content-Type: application/json");
    echo json_encode(array('status' => 'gagal'), JSON_PRETTY_PRINT);
  }
?>
