<?php
include "inc.koneksi.php";
include "inc.kodeauto.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Administrator</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css">
		<link rel="stylesheet" type="text/css" href="css/general.css" />
		<script type="text/javascript" charset="utf-8" language="javascript" src="js/jquery.js"></script>
		<script type="text/javascript" charset="utf-8" language="javascript" src="js/datatable.js"></script>
		<script type="text/javascript" charset="utf-8" language="javascript" src="js/boot.js"></script>
		<script type="text/javascript" charset="utf-8" language="javascript" src="js/bootstrap.min.js"></script>
		<link rel="shortcut icon" href="favicon.ico" />
	</head>
	<body>
	
	<nav class="navbar navbar-default navbar-static-top">
       <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          </button>
          <a class="navbar-brand" href="../index.php">Sistem Pakar Forward Chaining</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
			<li><a href="../index.php?page=consultation"><span class="glyphicon glyphicon-hand-up"></span> Konsultasi</a></li>
			<li><a href="../index.php?page=article"><span class="glyphicon glyphicon-info-sign"></span> Informasi</a></li>
            <li><a href="../index.php?page=guest"><span class="glyphicon glyphicon-book"></span> Buku Tamu</a></li>
			<li><a href="../index.php?page=profil"><span class="glyphicon glyphicon-user"></span> Profil</a></li>
            <li><a href="../index.php?page=contact"><span class="glyphicon glyphicon-phone-alt"></span> Kontak Kami</a></li>
			<li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          </ul>
        </div>
                   
      </div>
    </nav>
	
	
	
	<div class="container">
	
	
	
	  <form class="form-horizontal"  method="post" action="loginperiksa.php">
		<h3><span class="glyphicon glyphicon-log-in"></span> Login Admin</h3><br>
		<div class="form-group">
                    <div class="col-sm-4">
					<input class="form-control"  type="text" autofocus class="input-block-level" name="TxtUser" placeholder="Username" />
					</div>
		</div>
		
		<div class="form-group">
                    <div class="col-sm-4">
					<input type="password" class="form-control" name="TxtPasswd" placeholder="Password">
					</div>
		</div>
		
		<button class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-log-in"></span> Masuk</button>
	  
	  
	  
	  </form>
	</div>
	
	
	<footer class="footer bg-primary">
<div class="container" style="text-align:center;">
<p>Copyright &copy; UAS SISPAK by Fuad Tantri Ferdinan Ananda</p>
</div>
</footer>

</body>
</html>