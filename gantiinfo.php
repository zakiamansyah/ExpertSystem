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
// unset($_POST);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Profile - <?=$konfig['judul']?></title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="assets/css/vendor.css">
  <link rel="stylesheet" type="text/css" href="assets/css/flat-admin.css">

  <!-- Theme -->
  <link rel="stylesheet" type="text/css" href="assets/css/theme/blue-sky.css">
  <link rel="stylesheet" type="text/css" href="assets/css/theme/blue.css">
  <link rel="stylesheet" type="text/css" href="assets/css/theme/red.css">
  <link rel="stylesheet" type="text/css" href="assets/css/theme/yellow.css">
  <link rel="stylesheet" type="text/css" href="assets/sweetalert/dist/sweetalert.css">
  <script type="text/javascript" src="assets/sweetalert/dist/sweetalert-dev.js"></script>

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
        	<h4>Ganti Info</h4>
        	<div style="float: right;margin-top: -40px;"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#gantifoto">Ganti Foto</button></div><br>
        	<hr>
        	<form id="info" method="post">
        	   <div class="form-group">
	        		<label>Nama</label>
	                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?=$nama['nama']?>" required>
              </div>
              <div class="form-group">
	        		<label>Alamat</label>
	                <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat"><?=$nama['alamat']?></textarea>
              </div>
              <div class="form-group">
	        		<label>Jabatan</label>
	                <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan" value="<?=$nama['jabatan']?>" required>
              </div>
              <button type="submit" name="saveinfo" class="btn btn-primary">Simpan</button>
        	</form>
        	<br><br>

        	<h4>Ganti Password</h4><hr>
        	<form id="gantipass" method="post">
        	   <!-- <div class="form-group">
	        		<label>Password Lama</label>
	                <input type="text" class="form-control" name="passlama" id="passlama" placeholder="Password Lama" required>
              </div> -->
              <div class="form-group">
	        		<label>Password Baru</label>
	                <input type="password" class="form-control" name="password" id="password" placeholder="Password Baru" required>
              </div>
              <button type="submit" name="savepassword" class="btn btn-primary">Ganti Password</button>
        	</form>
        	<br><br>
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
  

<!-- Modal -->
  <div class="modal fade" id="gantifoto" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">User Baru</h4>
        </div>
        <div class="modal-body">
          <form method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                                                  Preview Gambar<br><img id="preview" src="" alt="" width="350px"/><br><br>
                                                  <input type="hidden" id="user" name="user" value="<?=$username?>">
                                                  <input type="hidden" id="fotolama" name="fotolama" value="<?=$nama['foto']?>">
                                                    <div class="form-group">
                                                  	<label>Foto</label>
                                                    <input type="file" class="form-control" name="foto" id="foto" onchange="tampilkanPreview(this,'preview')" required multiple>
                                                  </div>
                                              
                                            </div>
                                            <div class="modal-footer">
                                              <button type="submit" name="gantifotoe" class="btn btn-success">Ganti</button>
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                            </form>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="assets/js/vendor.js"></script>
  <script type="text/javascript" src="assets/js/app.js"></script>
  <script type="text/javascript" src="assets/sweetalert/dist/sweetalert.min.js"></script>
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
    <script type="text/javascript">
function tampilkanPreview(userfile,idpreview)
{ //membuat objek gambar
  var gb = userfile.files;
  //loop untuk merender gambar
  for (var i = 0; i < gb.length; i++)
  { //bikin variabel
    var gbPreview = gb[i];
    var imageType = /image.*/;
    var preview=document.getElementById(idpreview);            
    var reader = new FileReader();
    if (gbPreview.type.match(imageType)) 
    { //jika tipe data sesuai
      preview.file = gbPreview;
      reader.onload = (function(element) 
      {
        return function(e) 
        {
          element.src = e.target.result;
        };
      })(preview);
      //membaca data URL gambar
      reader.readAsDataURL(gbPreview);
    }
      else
      { //jika tipe data tidak sesuai
        alert("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
      }
  }    
}
</script>
<?php
    if (isset($_POST['gantifotoe'])) {
        if (!empty($_POST['fotolama'])) {
        $path = $_POST['fotolama'];
        $file= "assets/images/user/".$path;
        if (file_exists($file)) {
            unlink($file);
        }
    }
        $foto = $_FILES['foto']['name'];
        $tmp_foto = $_FILES['foto']['tmp_name'];
        if (!file_exists('assets/images/user/'.$foto)) {
        move_uploaded_file($tmp_foto, 'assets/images/user/'.$foto);
        $upload = mysql_query("UPDATE detailuser SET foto = '$foto' WHERE user='$username'");
        if ($upload) {
         echo '<script>swal({
  title: "Berhasil!",
  type: "success",
  text: "Foto Berhasil Di Ganti.",
  timer: 2000,
  showConfirmButton: false
});
setTimeout(function(){
        window.location = "gantiinfo.php";
        }, 2000);
  </script>';
         }else{
         echo '<script>swal({
  title: "Error!",
  type: "error",
  text: "Foto Tidak Berhasil Di Ganti.",
  timer: 2000,
  showConfirmButton: false
});
setTimeout(function(){
        window.location = "gantiinfo.php";
        }, 2000);
</script>';
         }
    }else{
        echo '<script>swal({
  title: "Error!",
  type: "error",
  text: "Foto Sudah Ada",
  timer: 2000,
  showConfirmButton: false
});
setTimeout(function(){
        window.location = "gantiinfo.php";
        }, 2000);
</script>';
    }
}

elseif (isset($_POST['saveinfo'])) {
	$ganti = mysql_query("UPDATE detailuser SET nama = '$_POST[nama]', alamat = '$_POST[alamat]', jabatan = '$_POST[jabatan]' WHERE user='$username'");
        if ($ganti) {
         echo '<script>swal({
  title: "Berhasil!",
  type: "success",
  text: "Data Berhasil Di Ganti.",
  timer: 2000,
  showConfirmButton: false
});
setTimeout(function(){
        window.location = "gantiinfo.php";
        }, 2000);
  </script>';
         }else{
         echo '<script>swal({
  title: "Error!",
  type: "error",
  text: "Data Tidak Berhasil Di Ganti.",
  timer: 2000,
  showConfirmButton: false
});
setTimeout(function(){
        window.location = "gantiinfo.php";
        }, 2000);
</script>';
         }
    
}

elseif (isset($_POST['savepassword'])) {
	$pass = md5($_POST['password']);
	$ganti = mysql_query("UPDATE user SET password = '$pass' WHERE username='$username'");
        if ($ganti) {
         echo '<script>swal({
  title: "Berhasil!",
  type: "success",
  text: "Password Berhasil Di Ganti.",
  timer: 2000,
  showConfirmButton: false
});
setTimeout(function(){
        window.location = "gantiinfo.php";
        }, 2000);
  </script>';
         }else{
         echo '<script>swal({
  title: "Error!",
  type: "error",
  text: "Password Tidak Berhasil Di Ganti.",
  timer: 2000,
  showConfirmButton: false
});
setTimeout(function(){
        window.location = "gantiinfo.php";
        }, 2000);
</script>';
         }
    
}
    ?>
</body>
</html>
