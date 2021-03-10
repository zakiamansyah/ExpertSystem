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

if(isset($_REQUEST['gejala'])){
$gejala= $_REQUEST['gejala'];
}else{
$gejala= "";
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Data Relasi Gejala - Pakar Virus Komputer</title>
  
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
  <script type="text/javascript">
  	function MM_jumpMenu(targ,selObj,restore){ //v3.0
	  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
	  if (restore) selObj.selectedIndex=0;
	}
  </script>
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
      <li><a href="./virus.php">Data Virus</a></li>
      <li><a href="./gejala.php">Data Gejala</a></li>
      <li><a href="./solusi.php">Data Solusi</a></li>
      <li><a href="./users.php">Daftar Users</a></li>
    </ul>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
      <div class="card">
        <div class="card-body">
          <form method="post" action="./ajax/relasi/addrelasigejala.php" target="_self" id="forminput">
	 <div class="form-group"> 
	   <label class="col-md-3  control-label">Nama Gejala</label>
	   <div class="col-md-9">
	   <select class="select2" onChange="MM_jumpMenu('parent',this,0)">
	        <option value="<?=$_SERVER['PHP_SELF'];?>"> [ Daftar Gejala ]</option>
			<?php
			$sqlp = "SELECT * FROM gejala ORDER BY id_gejala";
			$qryp = mysql_query($sqlp) or die ("SQL Error: ".mysql_error());
			while ($datap=mysql_fetch_array($qryp)) {
				if($datap['id_gejala']==$gejala) {
					$cek ="selected";
				}else{
				$cek ="";
				}

			echo "<option value='?gejala=$datap[id_gejala]' $cek> $datap[gejala] </option>";

			}
			?>
	      </select>
	      </div>
	   </div>
      <input name="gejala" type="hidden" id="gejala" value="<?=$gejala; ?>" /></td>
      <div class="form-group"> 
	   <label class="col-md-3  control-label">Daftar Solusi</label>
	   <div class="col-md-9">
	<?php
	$sql = "SELECT * FROM solusi ORDER BY id_solusi";
	$qry = mysql_query($sql) or die("SQL Error:".mysql_error());
	$no=0;
	while ($data = mysql_fetch_array($qry)){
		$no++;
		$sqlr = "SELECT * FROM relasigejala WHERE id_gejala='$gejala' AND id_solusi='$data[id_solusi]'";
		$qryr = mysql_query($sqlr);
		$cocok = mysql_num_rows($qryr); 
		if ($cocok==1){
			$cek = "checked";
			$bg = "#CCFF00";
		} else {
			$cek ="";
			$bg="";
		}
		?>
	<div class="checkbox">
	  <input name="CekSolusi[]" id="chk<?= $no; ?>" type="checkbox" value="<?= $data['id_solusi'];?>" <?= $cek; ?> > 
	  <label for="chk<?= $no; ?>">
	  <?= $data['solusi'];?> 
	  </label>
	</div>
	<?php
	}
	?>
     </div>

    <div class="form-footer">
    <div class="form-group">
      <div class="col-md-9 col-md-offset-3">
	  <input type="submit" name="Submit" id="save" value="Simpan" class="btn btn-info"> <a href="javascript:history.back()" class="btn btn-warning">Batal</a></td>
    </div>
   </div>
  </div>
</form>

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
