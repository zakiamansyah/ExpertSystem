<?php
include '../../../inc/inc.koneksi.php';
include '../../../inc/autonumber.php';
$kode = kodeotomatis('solusi','id_solusi',2,'SOL');
$solusi = $_POST['solusi'];
$sql = mysql_query("INSERT INTO solusi VALUES ('$kode','$solusi')");
if ($sql) {
	echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success!</strong> Anda berhasil menambah data.
</div>';
}else{
	echo '<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Error!</strong> Maaf terjadi kesalahan, data error.
</div>';
}

?>
