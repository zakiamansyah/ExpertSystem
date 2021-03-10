<?php
date_default_timezone_set('Asia/Jakarta');
setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
include '../../../inc/inc.koneksi.php';
include '../../../inc/autonumber.php';
$kode = kodeotomatis('artikel','id_artikel',2,'ART');
$judul = $_POST['judul'];
$artikel = $_POST['artikel'];
$file = $_FILES['file']['name'];
$tgl = date('Y-m-d H:i:s');
move_uploaded_file($_FILES['file']['tmp_name'], '../../../assets/images/details-program/' . $_FILES['file']['name']);
$sql = mysql_query("INSERT INTO artikel VALUES ('$kode','$judul','$artikel','$file','$tgl')");
if ($sql) {
	header("Content-Type: application/json");
    echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
}else{
	header("Content-Type: application/json");
    echo json_encode(array('status' => 'gagal'), JSON_PRETTY_PRINT);
}

?>
