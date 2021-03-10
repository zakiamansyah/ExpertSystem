<?php
include 'inc/inc.koneksi.php';
function mati(){
    echo "Akses dibatasi <a href='./index.php'>Kembali</a>";
    die();
  }
session_start();
if(!isset($_SESSION['username'])) {
  mati();
}elseif ($_SESSION['level'] == "admin" || $_SESSION['level'] == "kepala") {
  mati();
}else{ 
$username = $_SESSION['username']; 
$nama = mysql_fetch_array(mysql_query("SELECT * FROM detailuser WHERE user='$username'"));
}
if (!@$_REQUEST['program'] && !@$_SESSION['gejala']) {
  mati();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Laporan - <?=$konfig['judul']?></title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="assets/css/vendor.css">
  <link rel="stylesheet" type="text/css" href="assets/css/flat-admin.css">

  <!-- Theme -->
  <link rel="stylesheet" type="text/css" href="assets/css/theme/blue-sky.css">
  <link rel="stylesheet" type="text/css" href="assets/css/theme/blue.css">
  <link rel="stylesheet" type="text/css" href="assets/css/theme/red.css">
  <link rel="stylesheet" type="text/css" href="assets/css/theme/yellow.css">

</head>
<body>
<div class="row">
  <div class="col-xs-12">
      <div class="card">
        <div class="card-body">
        <print id="areaprint">
    <style type="text/css">
    @media print {
		   @page { margin: 0; }
		  /*body { margin: 1.6cm; }*/
		}
             /* @page 
                  {
                      size:  auto;
                      margin: 4mm;  
                  }*/
            </style>
          <?php
          if (empty($_SESSION['gejala'])) { ?>
          <center>
             <div class="jumbotron">
              <h1>SELAMAT!!</h1>
              <p>Tidak ada Gejala Pada Program.</p>
            </div>
          </center>
          <?php }else{ ?>
          <center><h3><b>Laporan Kerusakan Program POS (Point Of Sale)</b></h3></center><hr><br>
          <table class="table table-bordered">
        	<?php 
          
          
          // print_r($_SESSION['gejala']);die;
          $program = mysql_fetch_array(mysql_query("SELECT * FROM relasiprogram WHERE id_artikel = '$_REQUEST[program]'"));
          $rusak = $program['id_rusak'];
        	$sql = mysql_query("SELECT * FROM rusak WHERE id_rusak='$rusak'");
          $row = mysql_fetch_array($sql);
          $cekprogram = mysql_fetch_array(mysql_query("SELECT * FROM artikel WHERE id_artikel='$program[id_artikel]'"));
          echo '<tr><th>Nama User : </th><td>'.$nama['nama'].'</td></tr>';
          echo '<tr><th>Nama Program : </th><td>'.$cekprogram['judul'].'</td></tr>';
          echo '<tr><th>Kerusakan Yang Terdeteksi : </th><td>'.$row['nama_rusak'].'</td></tr>';
          

          $gejala = $_SESSION['gejala'];
          $count = count($gejala);
          $tung = $count+1;
          $itunggjl = mysql_num_rows(mysql_query("SELECT * FROM relasirusak WHERE id_rusak='$rusak'"));
          echo '<tr><th rowspan="'.$tung.'">Gejala Yang Terdeteksi (<small>'.$count.' Dari '.$itunggjl.' Gejala</small>) : </th></tr>';

          $gjl = array();
          foreach ($gejala as $datagejala => $val) {
          $gjl[] = $datagejala;
          // $masuklaporan = mysql_query("INSERT INTO laporan VALUES ('','$laporan','$rusak','$datagejala','$username')");
          $sqlg = mysql_query("SELECT * FROM gejala WHERE id_gejala='$datagejala'");
          $no = 1;
           while ($rowg = mysql_fetch_array($sqlg)) {
              echo '<tr><td>'.$rowg['gejala'].'</td></tr>';
              $no++;
           }
         }

         $numr = count($gjl);
         $ting = $numr+1;
         echo '<tr><th rowspan="'.$ting.'">Solusi : </th></tr>';
          foreach ($gjl as $gejalae) {
            $sqlr = mysql_query("SELECT distinct relasigejala.id_solusi FROM relasigejala, relasirusak WHERE relasirusak.id_rusak='$rusak' AND relasigejala.id_gejala='$gejalae'");
         $rowr = mysql_fetch_array($sqlr);
         $sol = $rowr['id_solusi'];
         $sqlr2 = mysql_query("SELECT * FROM solusi WHERE id_solusi='$sol'");

        while ($rowr2 = mysql_fetch_array($sqlr2)) {
              echo '<tr><td>'.$rowr2['solusi'].'</td></tr>';
              $no++;
           }
         }
         // unset($_SESSION['gejala']);
	      ?>
          </table>

        <?php
            $bagi = $count/$itunggjl;
            $kerusakan = number_format( $bagi * 100 );
            $bagi2 = 100-$kerusakan;
            ?>
          <script>
window.onload = function() {

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  title: {
    text: "Persentase Kerusakan"
  },
  data: [{
    type: "pie",
    startAngle: 240,
    yValueFormatString: "##0.00'%'",
    indexLabel: "{label} {y}",
    dataPoints: [
      {y: <?=$kerusakan?>, label: "Kerusakan"},
      {y: <?=$bagi2?>, label: "Tidak Rusak"}
    ]
  }]
});
chart.render();

}
</script>
          <div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>

          <script src="assets/js/canvasjs.min.js"></script>
      </print>
            <!-- <center><a id="back" class="btn btn-info">Kembali</a>  <button class="btn btn-primary" id="cetak">Print</button></center> -->
        </div>
        <?php } ?>
     </div>
    </div>
 </div>

  
  <script type="text/javascript" src="assets/js/vendor.js"></script>
  <script type="text/javascript" src="assets/js/app.js"></script>
  <script type="text/javascript" src="assets/js/jquery.PrintArea.js"></script>
  <script>
    $(document).ready(function(){
        $("#cetak").click(function(){
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = { mode : mode, popClose : close};
            $("print#areaprint").printArea( options );
        });
    });
    </script>
    <script>
    	 $('#back').click(function(){
        $.ajax({
              url: 'hasil.php?=bersih',
              success: function(data) {
                  window.location = 'detailsprogram.php';
              },
          });
      })
    </script>

</body>
</html>
