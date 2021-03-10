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
  <title>Artikel - <?=$konfig["judul"]?></title>
  
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
      <li class="@@menu.messaging active">
        <a href="./detailsprogram.php">
          <div class="icon">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
          </div>
          <div class="title">Details Program</div>
        </a>
      </li>
      <li class="dropdown ">
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
          <a href="./relasiprogram.php" class="btn btn-success"><i class="icon fa fa-database fa-1x"></i> Relasi Data Program & Kerusakan </a>
        </div>
        <div class="card-body no-padding">
          <table class="datatable table table-striped primary" cellspacing="0" width="100%">
              <thead>
                <tr>
                    <th>#</th>
                    <th>Program</th>
                    <th>Details Program</th>
                    <th>Foto</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                  $sql = mysql_query("SELECT * FROM artikel");
                  $no = 1;
                  while ($row = mysql_fetch_array($sql)) {
                    echo '<tr>
                                <td>'.$no.'</td>
                                <td>'.$row['judul'].'</td>
                                <td>'.substr($row['isi'],0,50).'...</td>
                                <td><img src="../assets/images/details-program/'.$row['foto'].'" width="200px" height="190px"></td>
                                <td>'.strftime('%d %B %Y, %X', strtotime($row['tanggal'])).'</td>
                                <td><button type="button" data-toggle="modal" data-target="#liat'.$row['id_artikel'].'" class="btn btn-info">Lihat</button> <button type="button" onclick=\'cek("'.$row['id_artikel'].'")\' data-toggle="modal" data-target="#myModal'.$row['id_artikel'].'" class="btn btn-primary">Update</button> <button type="button" class="btn btn-warning" onclick=\'deletedata("'.$row['id_artikel'].'")\'>Delete</button>
                                <div class="modal fade" id="myModal'.$row['id_artikel'].'" role="dialog">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Ubah Details Program</h4>
                                      </div>
                                      <div class="modal-body">
                                        <form method="post" action="" enctype="multipart/form-data">
                                        <input type="hidden" name="id_artikel" value="'.$row['id_artikel'].'">
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="upfile" name="upfile">
                                          </div>
                                            <div class="input-group">
                                              <input type="text" class="form-control" name="upjudul" id="upjudul" placeholder="Program" value="'.$row['judul'].'" required>
                                            </div>
                                            <div class="input-group">
                                              <textarea name="upartikel" id="upartikel'.$row['id_artikel'].'" class="form-control" style="height: 300px;" placeholder="Isi" required>'.$row['isi'].'</textarea>
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
                                <div class="modal fade" id="liat'.$row['id_artikel'].'" role="dialog">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Details Program '.$row['judul'].'</h4>
                                      </div>
                                      <div class="modal-body">
                                        <center><img src="../assets/images/details-program/'.$row['foto'].'" width="200px" height="190px"><br><b>'.$row['judul'].'</b><br><br><h6> Tanggal Modifikasi : '.strftime('%d %B %Y, %X', strtotime($row['tanggal'])).'</h6></center><br>
                                        <pre>'.$row['isi'].'</pre>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
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
        Copyright © 2018 <?=$konfig["judul"]?>
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
          <h4 class="modal-title">Details Program Baru</h4>
        </div>
        <div class="modal-body">
          <form id="forminput" enctype="multipart/form-data">
              <div class="input-group">
                <input type="file" class="form-control" id="pic" name="file" required>
              </div>
              <div class="input-group">
                <input type="text" class="form-control" name="judul" id="judul" placeholder="Program" required>
              </div>
              <div class="input-group">
                <textarea id="artikel" name="artikel" class="form-control" style="height: 300px;" placeholder="Isi" required></textarea>
              </div>
        </div>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" id="save" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>
 
<?php
  if (isset($_POST['update'])) {
    $id_artikel = $_POST['id_artikel'];
    $upjudul = $_POST['upjudul'];
    $upartikel = $_POST['upartikel'];
    $tgl = date('Y-m-d H:i:s');
    if($_FILES["upfile"]["error"] == 4) {
      $sql = mysql_query("UPDATE artikel SET judul = '$upjudul', isi = '$upartikel', tanggal = '$tgl' WHERE id_artikel = '$id_artikel'");
    }else{
    $upfile = $_FILES['upfile']['name'];
    move_uploaded_file($_FILES['upfile']['tmp_name'], '../assets/images/details-program/' . $_FILES['upfile']['name']);
    $sql = mysql_query("UPDATE artikel SET judul = '$upjudul', isi = '$upartikel', foto = '$upfile', tanggal = '$tgl' WHERE id_artikel = '$id_artikel'");
   }
      if ($sql) {
    echo '<script>swal({
  title: "Berhasil!",
  type: "success",
  text: "Data Berhasil diupdate.",
  timer: 2000,
  showConfirmButton: false
});
setTimeout(function(){
        window.location = "'.$konfig["url"].'admin/detailsprogram.php";
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
        window.location = "'.$konfig["url"].'admin/detailsprogram.php";
        }, 2000);
</script>';

  }
  }
  ?>    
  <script type="text/javascript" src="../assets/js/vendor.js"></script>
  <script type="text/javascript" src="../assets/js/app.js"></script>
  <script src="../assets/ckeditor/ckeditor.js"></script>
  <script src="../assets/ckeditor/config.js"></script>
  <script type="text/javascript" src="../assets/sweetalert/dist/sweetalert.min.js"></script>
  <script>
      CKEDITOR.replace( 'artikel',{
        toolbar : 'Basic',
        uiColor : '#9AB8F3'
    } );
      function cek(str) {
        CKEDITOR.replace( 'upartikel'+str,{
        toolbar : 'Basic',
        uiColor : '#9AB8F3'
    } );
      }
    </script>
  <script>
    $('#save').click(function(){
      CKEDITOR.instances.artikel.destroy();
      var file_data = $('#pic').prop('files')[0];
      var datas = new FormData($('#forminput')[0]);
      datas.append('file', file_data);
      //$("#forminput").serialize();

      $.ajax({
        url: "./ajax/artikel/save.php",
        dataType    : 'json',           // what to expect back from the PHP script, if anything
        cache       : false,
        contentType : false,
        processData : false,
        data: datas,
        type: "POST"
      }).done(function( data ) {
        $('#myModal').modal('hide')
        if (data.status == 'sukses') {
        $("#reload").load(location.href + " #reload");
        swal("Berhasil!", "Berhasil Di Simpan", "success");
      } else {
      swal("Gagal!", "Gagal Di Simpan", "error");
      }
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
         url: "./ajax/artikel/delete.php?id="+id
      }).done(function( data ) {
        if (data.status == 'sukses') {
        $("#reload").load(location.href + " #reload");
        swal("Berhasil!", "Berhasil dihapus", "success");
      } else {
      swal("Gagal!", "Gagal dihapus", "error");
      }
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
