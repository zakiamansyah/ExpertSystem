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
if (@$_GET['i'] == 'jam') {
  echo strftime('%d %B %Y, %X', strtotime(date('Y-m-d H:i:s')))." WIB";die;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Hasil - <?=$konfig['judul']?></title>
  
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
  <div class="app app-blue-sky">

<aside class="app-sidebar" id="sidebar">
  <div class="sidebar-header">
    <a class="sidebar-brand">&nbsp;<div id="jam"></div></a>
    <button type="button" class="sidebar-toggle">
      <i class="fa fa-times"></i>
    </button>
  </div>
  <div class="sidebar-menu">
    <ul class="sidebar-nav">
      <li class="">
        <a href="./index.php">
          <div class="icon">
            <i class="fa fa-tasks" aria-hidden="true"></i>
          </div>
          <div class="title">Dashboard</div>
        </a>
      </li>
      <li class="@@menu.messaging">
        <a href="./detailsprogram.php">
          <div class="icon">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
          </div>
          <div class="title">Details Program</div>
        </a>
      </li>
      <li class="@@menu.messaging active">
        <a href="./diagnosa.php">
          <div class="icon">
            <i class="fa fa-bug" aria-hidden="true"></i>
          </div>
          <div class="title">Diagnosa</div>
        </a>
      </li>

    </ul>
  </div>
</aside>

<script type="text/ng-template" id="sidebar-dropdown.tpl.html">
  <div class="dropdown-background">
    <div class="bg"></div>
  </div>
  <div class="dropdown-container">
    {{list}}
  </div>
</script>
<div class="app-container">

  <nav class="navbar navbar-default" id="navbar">
  <div class="container-fluid">
    <div class="navbar-collapse collapse in">
      <ul class="nav navbar-nav navbar-mobile">
        <li>
          <button type="button" class="sidebar-toggle">
            <i class="fa fa-bars"></i>
          </button>
        </li>
        <li class="logo">
          <a class="navbar-brand" href="./index.php"><h6>Penentuan Kerusakan Program POS (Point Of Sales) Dengan Pendekatan Sistem Pakar</h6></a>
        </li>
        <li>
          <button type="button" class="navbar-toggle">
            <img class="profile-img" src="<?=(($nama["foto"] == "")? "assets/images/profilenya.png" : "assets/images/user/".$nama["foto"]."")?>">
          </button>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-left">
        <li class="navbar-title">
          <img src="assets/images/logo.png" width="300px" height="90px">
        </li>
        <li class="navbar-title"><h6>Penentuan Kerusakan Program POS (Point Of Sales) Dengan Pendekatan Sistem Pakar</h6></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown profile">
          <a href="#" class="dropdown-toggle"  data-toggle="dropdown">
            <img class="profile-img" src="<?=(($nama["foto"] == "")? "assets/images/profilenya.png" : "assets/images/user/".$nama["foto"]."")?>">
            <div class="title">Profile</div>
          </a>
          <div class="dropdown-menu">
            <div class="profile-info">
              <h4 class="username"><?=$nama['nama'];?> (<?=$username;?>)</h4>
            </div>
            <ul class="action">
              <li>
                <a href="gantiinfo.php">
                  Ganti Info Profile
                </a>
              </li>
              <li>
                <a href="out.php">
                  Logout
                </a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>

  <div class="btn-floating" id="help-actions">
  <div class="btn-bg"></div>
  <button type="button" class="btn btn-default btn-toggle" data-toggle="toggle" data-target="#help-actions">
    <i class="icon fa fa-plus"></i>
    <span class="help-text">Shortcut</span>
  </button>
  <div class="toggle-content">
    <ul class="actions">
      <li><a href="./diagnosa.php">Diagnosa</a></li>
      <li><a href="./detailsprogram.php">Details Program</a></li>
    </ul>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
      <div class="card">
      <div class="card-header">
        <h3>Hasil</h3>
      </div>
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
          <table class="table table-bordered">
        	<?php 
          
          echo '<tr><th>Nama User : </th><td>'.$nama['nama'].'</td></tr>';
          echo '<tr><td colspan="2">';
          // print_r($_POST['CekGejala']);die;
          $gejala = $_POST['CekGejala'];
          $size = count($gejala);
          $count = 1;
          $sqlrusak = "SELECT *, COUNT(id_rusak) AS jumlah FROM relasirusak WHERE id_gejala in (";
          foreach ($gejala as $value) {
            $sqlrusak .= "'$value'";
            if($count < $size){
              $sqlrusak .= ",";
            }
            $count++;
          }
          $sqlrusak .= ") GROUP BY id_rusak ORDER BY jumlah DESC LIMIT 1";
          // echo $sqlrusak;die;
          $getrusak = mysql_query($sqlrusak);
          while ($rowrusak = mysql_fetch_array($getrusak)) {
            $rusak = mysql_fetch_array(mysql_query("SELECT * FROM rusak WHERE id_rusak='$rowrusak[id_rusak]'"));
            $program = mysql_fetch_array(mysql_query("SELECT * FROM relasiprogram WHERE id_rusak = '$rowrusak[id_rusak]'"));
            $cekprogram = mysql_fetch_array(mysql_query("SELECT * FROM artikel WHERE id_artikel='$program[id_artikel]'"));
            echo '<table class="table table-bordered">';
            echo '<h3>Program Berdasarkan Gejala Yang Lebih Dominan</h3>';
            echo '<tr><th width="350">Nama Program :</th><td>'.$cekprogram['judul'].'</td></tr>';
            echo '<tr><th>Kerusakan Yang Terdeteksi : </th><td>'.$rusak['nama_rusak'].'</td></tr>';
            $laporan = $_REQUEST['laporan']; 
            $a = 1;
            foreach ($gejala as $datagejala => $val) {
              $getgejala = mysql_fetch_array(mysql_query("SELECT * FROM relasirusak WHERE id_rusak='$rowrusak[id_rusak]' AND id_gejala ='$val'"));
              
              $sqlg = mysql_query("SELECT * FROM gejala WHERE id_gejala='$getgejala[id_gejala]'");
               while ($rowg = mysql_fetch_array($sqlg)) {
                $masuklaporan = mysql_query("INSERT INTO laporan VALUES ('','$laporan','$cekprogram[id_artikel]','$rowrusak[id_rusak]','$rowg[id_gejala]','$username')");
                  $a += 1;
               }
            }
            echo '<tr><th rowspan="'.$a.'">Gejala Yang Terdeteksi : </th></tr>';
              foreach ($gejala as $datagejala => $val) {
              $getgejala = mysql_fetch_array(mysql_query("SELECT * FROM relasirusak WHERE id_rusak='$rowrusak[id_rusak]' AND id_gejala ='$val'"));
              $sqlg = mysql_query("SELECT * FROM gejala WHERE id_gejala='$getgejala[id_gejala]'");
               while ($rowg = mysql_fetch_array($sqlg)) {
                  echo '<tr><td>'.$rowg['gejala'].'</td></tr>';
               }
             }

             echo '<tr><th rowspan="'.$a.'">Solusi : </th></tr>';
              foreach ($gejala as $datagejala => $val) {
                $getgejala = mysql_fetch_array(mysql_query("SELECT * FROM relasirusak WHERE id_rusak='$rowrusak[id_rusak]' AND id_gejala ='$val'"));
                $sqlr = mysql_query("SELECT distinct relasigejala.id_solusi FROM relasigejala, relasirusak WHERE relasirusak.id_rusak='$rusak[id_rusak]' AND relasigejala.id_gejala='$getgejala[id_gejala]'");
                $rowr = mysql_fetch_array($sqlr);
                $sol = $rowr['id_solusi'];
                $sqlr2 = mysql_query("SELECT * FROM solusi WHERE id_solusi='$sol'");

                while ($rowr2 = mysql_fetch_array($sqlr2)) {
                      echo '<tr><td>'.$rowr2['solusi'].'</td></tr>';
                 }
           }
             echo "</table><br><br>";
          }
          echo '</td></tr>';
          



	      ?>
          </table>
        </print>
         
            <center><a href="diagnosa.php" class="btn btn-info">Kembali</a>
              <button class="btn btn-primary" type="button" id="cetak">Print</button></center>
        </div>
     </div>
    </div>
 </div>

  <footer class="app-footer"> 
  <div class="row">
    <div class="col-xs-12">
      <div class="footer-copyright">
        Copyright © 2018 <?=$konfig['judul']?>
      </div>
    </div>
  </div>
</footer>
</div>

  </div>
  
  <script type="text/javascript" src="assets/js/vendor.js"></script>
  <script type="text/javascript" src="assets/js/app.js"></script>
  <script src="assets/js/canvasjs.min.js"></script>
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
  <script type="text/javascript">
      $(document).ready(function() {
          setInterval(timestamp, 1000);
      });

      function timestamp() {
          $.ajax({
              url: 'test.php',
              success: function(data) {
                  $('#jam').html(data);
              },
          });
      }
    </script>

</body>
</html>
