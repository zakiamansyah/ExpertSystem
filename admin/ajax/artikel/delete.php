<?php
include '../../../inc/inc.koneksi.php';
$id = $_GET['id'];
$hapus = mysql_fetch_array(mysql_query("SELECT * FROM artikel WHERE id_artikel='$id'"));
unlink('../../../assets/images/details-program/'.$hapus["foto"]);
$sql = mysql_query("DELETE FROM artikel WHERE id_artikel='$id'");
if ($sql) {
      	header("Content-Type: application/json");
    echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
  } else {
  	header("Content-Type: application/json");
    echo json_encode(array('status' => 'gagal'), JSON_PRETTY_PRINT);
  }

?>
