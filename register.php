<?php
session_start();
if(isset($_SESSION['username'])) {
header('location:index.php'); 
}
include 'inc/inc.koneksi.php';

?>
<!DOCTYPE html>
<html>
<head>
  <title>Register - <?=$konfig['judul']?></title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="assets/css/vendor.css">
  <link rel="stylesheet" type="text/css" href="assets/css/flat-admin.css">

  <!-- Theme -->
  <link rel="stylesheet" type="text/css" href="assets/css/theme/blue-sky.css">
  <link rel="stylesheet" type="text/css" href="assets/css/theme/blue.css">
  <link rel="stylesheet" type="text/css" href="assets/css/theme/red.css">
  <link rel="stylesheet" type="text/css" href="assets/css/theme/yellow.css">
  <style type="text/css">
    .app-login {
  background: #39c3da; }
  .app-login .app-body .app-block .app-right-section {
    background-color: #1d9baf;
  }
  </style>
</head>
<body>
  <div class="app app-blue-sky">

<div class="app-container app-login">
  <div class="flex-center">
    <div class="app-header"></div>
    <div class="app-body">
      <div class="loader-container text-center">
          <div class="icon">
            <div class="sk-folding-cube">
                <div class="sk-cube1 sk-cube"></div>
                <div class="sk-cube2 sk-cube"></div>
                <div class="sk-cube4 sk-cube"></div>
                <div class="sk-cube3 sk-cube"></div>
              </div>
            </div>
          <div class="title">Logging in...</div>
      </div>
      <div class="app-block">
        <div class="app-right-section">
          <div class="app-brand">Penentuan Kerusakan Program <b>POS (Point Of Sales)</b><br> Dengan Pendekatan Sistem Pakar<br> Dengan Metode Backward Chaining</div>
          <div class="app-info">
            
            <ul class="list">
              <li>
                <div class="icon">
                  <!-- <i class="fa fa-desktop fa-lg" aria-hidden="true"></i> -->
                </div>
                <div class="title">Mengetahui <b>Gejala</b> Pada Program</div>
              </li>
              <li>
                <div class="icon">
                  <!-- <i class="fa fa-list fa-lg" aria-hidden="true"></i> -->
                </div>
                <div class="title">Mengetahui <b>Solusinya</b></div>
              </li>
              <li>
                <div class="icon">
                  <!-- <i class="fa fa-check fa-lg" aria-hidden="true"></i> -->
                </div>
                <div class="title"><b>Mudah</b></div>
              </li>
            </ul>
          </div>
        </div>
        <div class="app-form">
          <div class="form-suggestion">
            Create an account for free.
          </div>
<?php
if (isset($_POST['submit'])) { 
$nama = $_POST['nama'];
$username = $_POST['username'];
$result2 = mysql_query("SELECT * FROM user WHERE username = '$username'");
$row2 = mysql_fetch_array($result2);
$pass=md5($_POST['password']);
$cpass=md5($_POST['c_password']);
$level="user";
if($pass !=="$cpass"){
                print '<div class="alert alert-dismissable alert-danger">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Pastikan Pengulangan Password Sama!</strong>
                        </div>'; 
}else
if($row2['username']=="$username"){
                print '<div class="alert alert-dismissable alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <strong>Username Telah digunakan</strong>
                        </div>';  
}else
if($row2['username']!="$username"){
$sql="INSERT INTO user VALUES ('','$username', '$pass', '$nama', '$level')";
$reg = mysql_query($sql);
if ($reg) {
        print '<div class="alert alert-dismissable alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>Registrasi Berhasil!</strong>
                </div>';    
}else{
  print '<div class="alert alert-dismissable alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <strong>Register Gagal!</strong>
                        </div>';  
}                                
}               
}
?>
          <form action="" method="POST">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon2">
                  <i class="fa fa-user" aria-hidden="true"></i></span>
                <input type="text" class="form-control" name="nama" placeholder="Nama" aria-describedby="basic-addon2">
              </div>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon2">
                  <i class="fa fa-user" aria-hidden="true"></i></span>
                <input type="text" class="form-control" name="username" placeholder="Username" aria-describedby="basic-addon2">
              </div>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">
                  <i class="fa fa-key" aria-hidden="true"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="basic-addon3">
              </div>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon4">
                  <i class="fa fa-check" aria-hidden="true"></i></span>
                <input type="password" name="c_password" class="form-control" placeholder="Confirm Password" aria-describedby="basic-addon4">
              </div>
              <div class="text-center">
                  <input type="submit" name="submit" class="btn btn-info btn-submit" value="Register">
              </div>
          </form>
          <div class="form-line">
            <div class="title">OR</div>
          </div>
          <div class="form-footer">
            <a href="login.php" class="btn btn-info btn-submit">
            <div class="info">
              <i class="icon fa fa-user" aria-hidden="true"></i>
              <span class="title">Sign In</span>
            </div>
          </a>
          </div>
        </div>
      </div>
    </div>
    <div class="app-footer">
    </div>
  </div>
</div>

  </div>
  
  <script type="text/javascript" src="assets/js/app.js"></script>
  <script type="text/javascript" src="assets/js/jquery2.0.3.min.js"></script>
  <script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 5000);
      </script>
</body>
</html>
