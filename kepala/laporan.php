<?php
include '../inc/inc.koneksi.php';
session_start();
if(!isset($_SESSION['username'])) {
    header('location:../login.php');
}elseif ($_SESSION['level'] == "user") {
    header('location:../index.php');
}elseif ($_SESSION['level'] == "admin") {
    header('location:../admin/index.php');
}else{ 
$username = $_SESSION['username']; 
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Data Laporan - <?=$konfig['judul']?></title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="../assets/css/vendor.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/flat-admin.css">

  <!-- Theme -->
  <link rel="stylesheet" type="text/css" href="../assets/css/theme/blue-sky.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/theme/blue.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/theme/red.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/theme/yellow.css">

  <link rel="stylesheet" type="text/css" href="../assets/sweetalert/dist/sweetalert.css">
  <script type="text/javascript" src="../assets/sweetalert/dist/sweetalert-dev.js"></script>

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
      <li class="dropdown active">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <div class="icon">
            <i class="fa fa-cube" aria-hidden="true"></i>
          </div>
          <div class="title">Data</div>
        </a>
        <div class="dropdown-menu">
          <ul>
            <li class="section"><i class="fa fa-file-o" aria-hidden="true"></i> Data Laporan</li>
            <li><a href="./laporan.php">Laporan</a></li>
          </ul>
        </div>
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
            <img class="profile-img" src="../assets/images/profilenya.png">
          </button>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-left">
        <li class="navbar-title">
          <img src="../assets/images/logo.png" width="300px" height="90px">
        </li>
        <li class="navbar-title"><h6>Penentuan Kerusakan Program POS (Point Of Sales) Dengan Pendekatan Sistem Pakar</h6></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown profile">
          <a href="#" class="dropdown-toggle"  data-toggle="dropdown">
            <img class="profile-img" src="../assets/images/profilenya.png">
            <div class="title">Profile</div>
          </a>
          <div class="dropdown-menu">
            <div class="profile-info">
              <h4 class="username"><?=$username;?></h4>
            </div>
            <ul class="action">
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
      <li><a href="./laporan.php">Data Laporan</a></li>
    </ul>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body no-padding">
          <table class="datatable table table-striped primary" cellspacing="0" width="100%">
              <thead>
                <tr>
                    <th>#</th>
                    <th>ID Laporan</th>
                    <th>Nama User</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                  $sql = mysql_query("SELECT * FROM laporan GROUP BY id_laporan");
                  $no = 1;
                  while ($row = mysql_fetch_array($sql)) {
                    $nama = mysql_fetch_array(mysql_query("SELECT * FROM detailuser WHERE user='$row[user]'"));
                    echo '<tr>
                                <td>'.$no.'</td>
                                <td>'.$row['id_laporan'].'</td>
                                <td>'.$nama['nama'].'</td>
                                <td><a href="hasil.php?id='.$row['id_laporan'].'" class="btn btn-info">Lihat Hasil</a> </td>
                            </tr>
                            ';
                    $no++;
                  }
                ?>
            </tbody>
          </table>
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


  <script type="text/javascript" src="../assets/js/vendor.js"></script>
  <script type="text/javascript" src="../assets/js/app.js"></script>
  <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
  <script type="text/javascript" src="../assets/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript">
      $(document).ready(function() {
          setInterval(timestamp, 1000);
      });

      function timestamp() {
          $.ajax({
              url: 'index.php?i=jam',
              success: function(data) {
                  $('#jam').html(data);
              },
          });
      }
    </script>

</body>
</html>
