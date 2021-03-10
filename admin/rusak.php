<?php
date_default_timezone_set('Asia/Jakarta');
setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
include '../inc/inc.koneksi.php';
session_start();
if(!isset($_SESSION['username'])) {
    header('location:../login.php');
}elseif ($_SESSION['level'] == "user") {
    header('location:../index.php');
}elseif ($_SESSION['level'] == "kepala") {
    header('location:../kepala/index.php');
}else{ 
$username = $_SESSION['username']; 
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Data Kerusakan - <?=$konfig['judul']?></title>
  
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
      <li class="@@menu.messaging">
        <a href="./detailsprogram.php">
          <div class="icon">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
          </div>
          <div class="title">Details Program</div>
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
            <li class="section"><i class="fa fa-file-o" aria-hidden="true"></i> Data Diagnosa</li>
            <li><a href="./rusak.php">Data Rusak</a></li>
            <li><a href="./gejala.php">Data Gejala</a></li>
            <li><a href="./solusi.php">Data Solusi</a></li>
            <li class="line"></li>
            <li class="section"><i class="fa fa-users" aria-hidden="true"></i> Data User</li>
            <li><a href="./users.php">Daftar Users</a></li> 
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
            <img class="profile-img" src="../assets/images/profile.png">
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
            <img class="profile-img" src="../assets/images/profile.png">
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
      <li><a href="./rusak.php">Data Rusak</a></li>
      <li><a href="./gejala.php">Data Gejala</a></li>
      <li><a href="./solusi.php">Data Solusi</a></li>
      <li><a href="./users.php">Daftar Users</a></li>
    </ul>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="icon fa fa-plus fa-1x"></i> Input Data </button>
          <a href="./relasirusak.php" class="btn btn-success"><i class="icon fa fa-database fa-1x"></i> Relasi Data Kerusakan & Gejala </a>
        </div>
        <div class="card-body no-padding">
          <table class="datatable table table-striped primary" cellspacing="0" width="100%">
              <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Kerusakan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                  $sql = mysql_query("SELECT * FROM rusak");
                  $no = 1;
                  while ($row = mysql_fetch_array($sql)) {
                    echo '<tr>
                                <td>'.$no.'</td>
                                <td>'.$row['nama_rusak'].'</td>
                                <td><button type="button" data-toggle="modal" data-target="#myModal'.$row['id_rusak'].'" class="btn btn-primary">Update</button> <button type="button" class="btn btn-warning" onclick=\'deletedata("'.$row['id_rusak'].'")\'>Delete</button>
                                <div class="modal fade" id="myModal'.$row['id_rusak'].'" role="dialog">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Ubah Data Virus</h4>
                                      </div>
                                      <div class="modal-body">
                                        <form method="post" action="">
                                        <input type="hidden" name="id_rusak" value="'.$row['id_rusak'].'">
                                            <div class="input-group">
                                              <input type="text" class="form-control" name="uprusak" id="uprusak" placeholder="Nama Kerusakan" value="'.$row['nama_rusak'].'" required>
                                            </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" name="update" class="btn btn-primary">Submit</button>
                                      </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                </td>
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
        Copyright © 2017 Pakar Virus Komputer.
      </div>
    </div>
  </div>
</footer>
</div>

  </div>

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kerusakan Baru</h4>
        </div>
        <div class="modal-body">
          <form id="forminput">
              <div class="input-group">
                <input type="text" class="form-control" id="rusak" placeholder="Nama Kerusakan" required>
              </div>
           </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" id="save" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>
  
<?php
  if (isset($_POST['update'])) {
    $id_rusak = $_POST['id_rusak'];
    $uprusak = $_POST['uprusak'];
    $sql = mysql_query("UPDATE rusak SET nama_rusak='$uprusak' WHERE id_rusak='$id_rusak'");
if ($sql) {
    echo '<script>swal({
  title: "Berhasil!",
  type: "success",
  text: "Data Berhasil diupdate.",
  timer: 2000,
  showConfirmButton: false
});
setTimeout(function(){
        window.location = "'.$konfig["url"].'admin/rusak.php";
        }, 2000);
  </script>';
  } else {
     echo '<script>swal({
  title: "Error!",
  type: "error",
  text: "Data Tidak Terupdate.",
  timer: 2000,
  showConfirmButton: false
});
setTimeout(function(){
        window.location = "'.$konfig["url"].'admin/rusak.php";
        }, 2000);
</script>';

  }
  }
  ?>
  <script type="text/javascript" src="../assets/js/vendor.js"></script>
  <script type="text/javascript" src="../assets/js/app.js"></script>
  <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
  <script type="text/javascript" src="../assets/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    $('#save').click(function(){

      var rusak = $('#rusak').val();

      var datas="rusak="+rusak;

      $.ajax({
         type: "POST",
         url: "./ajax/rusak/save.php",
         data: datas
      }).done(function( data ) {
        $('#myModal').modal('hide')
        swal("Berhasil!", "Berhasil ditambahkan", "success");
        document.getElementById("forminput").reset();
        setTimeout(function(){
        location.reload();
        }, 2000);
      });
    });
  </script>
<script>
    function deletedata(str){
      var id = str;
      swal({
  title: "Peringatan!!",
  text: "Apakah Anda Yakin Ingin Menghapusnya??",
  type: "info",
  showCancelButton: true,
  closeOnConfirm: false,
  showLoaderOnConfirm: true,
},function(){
          
      $.ajax({
         type: "POST",
         url: "./ajax/rusak/delete.php?id="+id
      }).done(function( data ) {
        swal("Berhasil!!", "Data Berhasil Terhapus", "success");
      setTimeout(function(){
        location.reload();
        }, 2000);
      });
});
      
    }
  </script>
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
