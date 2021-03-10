<?php
include '../../../inc/inc.koneksi.php';
$kode = $_GET['id'];
$rusak = $_POST['uprusak'];
$sql = mysql_query("UPDATE rusak SET nama_rusak='$rusak' WHERE id_rusak='$kode'");
if ($sql) {
	echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success!</strong> Anda berhasil mengubah data.
</div>';
}else{
	echo '<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Error!</strong> Maaf terjadi kesalahan, data error.
</div>';
}

?>
