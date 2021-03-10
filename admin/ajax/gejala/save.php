<?php
include '../../../inc/inc.koneksi.php';
include '../../../inc/autonumber.php';
$kode = kodeotomatis('gejala','id_gejala',2,'GJL');
$gejala = $_POST['gejala'];
$sql = mysql_query("INSERT INTO gejala VALUES ('$kode','$gejala')");
if ($sql) {
	header("Content-Type: application/json");
    echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
}else{
	header("Content-Type: application/json");
    echo json_encode(array('status' => 'gagal'), JSON_PRETTY_PRINT);
}
?>
