<?php
include '../../../inc/inc.koneksi.php';
include '../../../inc/autonumber.php';

# Baca Variabel Form ( If Register Global ON)
$program = $_REQUEST['program'];
//$CekGejala = $_REQUEST['CekGejala'];
if(isset($_REQUEST['CekRusak'])){
$CekRusak= $_REQUEST['CekRusak'];
}else{
$CekRusak= "";
}
#Validasi Form
if (trim($program)=="") {
	header("location:../../relasiprogram.php?program=$program");
}
else {
	$jum = count($CekRusak);
	if ($jum==0) {
		echo "BELUM ADA KERUSAKAN YANG DIPILIH";
	}
	else {

	$sqlpil = "SELECT * from relasiprogram WHERE id_artikel ='$program'";
	$qrypil = mysql_query($sqlpil);
	while ($datapil = mysql_fetch_array($qrypil)){
		//Kode untuk mengurai gejala yang dipilih
		for ($i = 0 ; $i < $jum; ++$i) {
		
		if ($datapil['id_rusak'] != $CekRusak[$i]){
				$sqldel = "DELETE FROM relasiprogram ";
				$sqldel .= "WHERE id_artikel ='$program'";
				$sqldel .= "AND NOT id_rusak
					IN ('$CekRusak[$i]')";
				mysql_query($sqldel);
			}
		}
	}


for ($i = 0; $i < $jum; ++$i) {

	$sqlr = "SELECT * FROM relasiprogram WHERE id_artikel='".$program."' AND id_rusak='".$CekRusak[$i]."'";
	$qryr = mysql_query($sqlr, $con);
	$cocok = mysql_num_rows($qryr);
	//GEJALA YANG BARU AKAN DISIMPAN
	if(! $cocok==1) {
		$kode = kodeotomatis('relasiprogram','id_relasiprogram',2,'RELPROG');
		$sql = "INSERT INTO relasiprogram(id_relasiprogram, id_artikel, id_rusak)";
		$sql .="VALUES ('$kode','$program','$CekRusak[$i]')";
	mysql_query($sql, $con)
		or die ("SQL INPUT RELASI GAGAL" .mysql_error());
	}
}
	header("location:../../relasiprogram.php?program=$program");

}
}
?>
