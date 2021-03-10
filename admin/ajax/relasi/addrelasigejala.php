<?php
include '../../../inc/inc.koneksi.php';
include '../../../inc/autonumber.php';

# Baca Variabel Form ( If Register Global ON)
$gejala = $_REQUEST['gejala'];

if(isset($_REQUEST['CekSolusi'])){
$CekSolusi= $_REQUEST['CekSolusi'];
}else{
$CekSolusi= "";
}
#Validasi Form
if (trim($gejala)=="") {
	header("location:../../relasigejala.php?gejala=$gejala");
}
else {
	$jum = count($CekSolusi);
	if ($jum==0) {
		echo "BELUM ADA GEJALA YANG DIPILIH";
	}
	else {

	$sqlpil = "SELECT * from relasigejala WHERE id_gejala ='$gejala'";
	$qrypil = mysql_query($sqlpil);
	while ($datapil = mysql_fetch_array($qrypil)){
		//Kode untuk mengurai gejala yang dipilih
		for ($i = 0 ; $i < $jum; ++$i) {
		
		if ($datapil['id_gejala'] != $CekSolusi[$i]){
				$sqldel = "DELETE FROM relasigejala ";
				$sqldel .= "WHERE id_gejala ='$gejala'";
				$sqldel .= "AND NOT id_solusi
					IN ('$CekSolusi[$i]')";
				mysql_query($sqldel);
			}
		}
	}


for ($i = 0; $i < $jum; ++$i) {

	$sqlr = "SELECT * FROM relasigejala WHERE id_gejala='".$gejala."' AND id_solusi='".$CekSolusi[$i]."'";
	$qryr = mysql_query($sqlr, $con);
	$cocok = mysql_num_rows($qryr);
	//GEJALA YANG BARU AKAN DISIMPAN
	if(! $cocok==1) {
		$kode = kodeotomatis('relasigejala','id_relasigejala',2,'RELGEJ');
		$sql = "INSERT INTO relasigejala(id_relasigejala, id_gejala, id_solusi)";
		$sql .="VALUES ('$kode','$gejala','$CekSolusi[$i]')";
	mysql_query($sql, $con)
		or die ("SQL INPUT RELASI GAGAL" .mysql_error());
	}
}
	header("location:../../relasigejala.php?gejala=$gejala");

}
}
?>
