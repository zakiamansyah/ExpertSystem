<?php
date_default_timezone_set('Asia/Jakarta');
setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
include 'inc/inc.koneksi.php';
session_start();
if(!isset($_SESSION['username'])) {
    header('location:login.php');
}elseif ($_SESSION['level'] == "admin") {
    header('location:./admin/index.php');
}else{ 
$username = $_SESSION['username']; 
$nama = mysql_fetch_array(mysql_query("SELECT * FROM detailuser WHERE user='$username'"));
unset($_SESSION['gejala']);
unset($_POST);
}
if (!@$_REQUEST['program']) {
	header('location:detailsprogram.php');
}
$id = $_REQUEST['program'];
$sqlt = mysql_query("SELECT * FROM artikel WHERE id_artikel='$id'");
$rowt = mysql_fetch_array($sqlt);
if (empty($_GET['program']) || $rowt['id_artikel'] != $_GET['program']) {
      echo '<script>window.location = "detailsprogram.php";</script>';
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Program <?=$rowt['judul']?>  - <?=$konfig['judul']?></title>
  
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
      <li class="@@menu.messaging active">
        <a href="./detailsprogram.php">
          <div class="icon">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
          </div>
          <div class="title">Details Program</div>
        </a>
      </li>
      <li class="@@menu.messaging">
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
        <div class="card-body">
          <h1><?=$rowt['judul']?></h1>
          <div style="float: right;margin-top: -40px;"><span class="badge badge-success"> Tanggal Modifikasi : <?=strftime('%d %B %Y, %X', strtotime($rowt['tanggal']))?></span></div>
          <hr>
          <center><img src="assets/images/details-program/<?=$rowt['foto']?>" width="400px" height="390px"></center><br>
          <br><br>
          <?=$rowt['isi']?>
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
