<?php
include '../../../inc/inc.koneksi.php';
include '../../../inc/autonumber.php';
$username = $_POST['username'];
$password = md5($_POST['password']);
$level = $_POST['level'];
$sql = mysql_query("INSERT INTO user VALUES ('','$username','$password','','$level')");
if ($sql) {
	header("Content-Type: application/json");
    echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
}else{
	header("Content-Type: application/json");
    echo json_encode(array('status' => 'gagal'), JSON_PRETTY_PRINT);
}
?>
