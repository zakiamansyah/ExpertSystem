<?php
include '../../../inc/inc.koneksi.php';
include '../../../inc/autonumber.php';

# Baca Variabel Form ( If Register Global ON)
$rusak = $_REQUEST['rusak'];
//$CekGejala = $_REQUEST['CekGejala'];
if(isset($_REQUEST['CekGejala'])){
$CekGejala= $_REQUEST['CekGejala'];
}else{
$CekGejala= "";
}
#Validasi Form
if (trim($rusak)=="") {
	header("location:../../relasirusak.php?rusak=$rusak");
}
else {
	$jum = count($CekGejala);
	if ($jum==0) {
		echo "BELUM ADA GEJALA YANG DIPILIH";
	}
	else {

	$sqlpil = "SELECT * from relasirusak WHERE id_rusak ='$rusak'";
	$qrypil = mysql_query($sqlpil);
	while ($datapil = mysql_fetch_array($qrypil)){
		//Kode untuk mengurai gejala yang dipilih
		for ($i = 0 ; $i < $jum; ++$i) {
		
		if ($datapil['id_gejala'] != $CekGejala[$i]){
				$sqldel = "DELETE FROM relasirusak ";
				$sqldel .= "WHERE id_rusak ='$rusak'";
				$sqldel .= "AND NOT id_gejala
					IN ('$CekGejala[$i]')";
				mysql_query($sqldel);
			}
		}
	}


for ($i = 0; $i < $jum; ++$i) {

	$sqlr = "SELECT * FROM relasirusak WHERE id_rusak='".$rusak."' AND id_gejala='".$CekGejala[$i]."'";
	$qryr = mysql_query($sqlr, $con);
	$cocok = mysql_num_rows($qryr);
	//GEJALA YANG BARU AKAN DISIMPAN
	if(! $cocok==1) {
		$kode = kodeotomatis('relasirusak','id_relasirusak',2,'RELRSK');
		$sql = "INSERT INTO relasirusak(id_relasirusak, id_rusak, id_gejala)";
		$sql .="VALUES ('$kode','$rusak','$CekGejala[$i]')";
	mysql_query($sql, $con)
		or die ("SQL INPUT RELASI GAGAL" .mysql_error());
	}
}
	header("location:../../relasirusak.php?rusak=$rusak");

}
}
?>
