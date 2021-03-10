<?php
session_start();
include 'inc/inc.koneksi.php';
$username = $_POST['username'];
$pass = md5($_POST['password']);
$cekuser = mysql_query("SELECT * FROM user WHERE username = '$username' AND password ='$pass'");
$jumlah = mysql_num_rows($cekuser);
$hasil = mysql_fetch_array($cekuser);
if($jumlah == 0) {
	header('location:login.php?login=gagal');
	}elseif ($hasil[password] != $pass) {
	header('location:login.php?login=gagal');
	}elseif ($hasil[level] == "admin") {
	$_SESSION['username'] = $hasil[username];
	$_SESSION['level'] = $hasil[level];
	header('location:./admin/index.php');
	}elseif ($hasil[level] == "kepala") {
	$_SESSION['username'] = $hasil[username];
	$_SESSION['level'] = $hasil[level];
	header('location:./kepala/index.php');
	}else{
$_SESSION['username'] = $hasil[username];
$_SESSION['level'] = $hasil[level];
header('location:index.php');
}
?>
