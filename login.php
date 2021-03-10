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
  <title>Login - <?=$konfig['judul']?></title>
  
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
  </style>
</head>
<body>
  <div class="app app-blue-sky">

<div class="app-container app-login"><br><br>
  <center><h3 style="color:white;">Penentuan Kerusakan Program POS (Point Of Sales) Dengan Pendekatan Sistem Pakar Dengan Metode Backward Chaining </h3></center>
  <br><br>
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
      <div class="app-form">
        <div class="form-header">
          <div class="app-brand"><img src="assets/images/logo.png" width="300px" height="90px"></div>
        </div>
        <form action="ceklogin.php" method="POST">
            <?php
                                    error_reporting(0);
                                    if ($_GET['login'] == 'gagal') {
                                      echo '<div class="alert alert-danger" role="alert">
                                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                  <strong>Login Failed!</strong>
                                                </div>';
                                    }
                                    ?>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">
                <i class="fa fa-user" aria-hidden="true"></i></span>
              <input type="text" class="form-control" name="username" placeholder="Username" aria-describedby="basic-addon1">
            </div>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon2">
                <i class="fa fa-key" aria-hidden="true"></i></span>
              <input type="password" class="form-control" name="password" placeholder="Password" aria-describedby="basic-addon2">
            </div>
            <div class="text-center">
                <input type="submit" name="submit" class="btn btn-info btn-submit" value="Login">
            </div>
        </form>

        <div class="form-line">
          <div class="title">OR</div>
        </div>
        <div class="form-footer">
          <a href="register.php" class="btn btn-info btn-submit">
            <div class="info">
              <i class="icon fa fa-user-plus" aria-hidden="true"></i>
              <span class="title">Sign Up</span>
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
