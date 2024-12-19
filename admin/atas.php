
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Administrator</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstraptable.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css">
		<link rel="stylesheet" type="text/css" href="css/general.css" />
		<link rel="shortcut icon" href="favicon.ico" />
		<script type="text/javascript" charset="utf-8" language="javascript" src="js/jquery.js"></script>
		<script type="text/javascript" charset="utf-8" language="javascript" src="js/datatable.js"></script>
		<script type="text/javascript" charset="utf-8" language="javascript" src="js/boot.js"></script>
		<script type="text/javascript" charset="utf-8" language="javascript" src="js/bootstrap.min.js"></script>
	</head>
	<body>

	
	<nav class="navbar navbar-default navbar-static-top">
	 <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          </button>
          <a class="navbar-brand" href="admin.php?home"><span class="glyphicon glyphicon-home"></span> Dashboard</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
			<li><a href="artikel.php?data"><span class="glyphicon glyphicon-book"></span> Data Artikel</a></li>
			<li><a href="solusi.php?data"><span class="glyphicon glyphicon-folder-close"></span> Data Penyakit & Solusi</a></li>
			<li><a href="gejala.php?data"><span class="glyphicon glyphicon-tasks"></span> Data Gejala</a></li>
			<li><a href="rule.php?data"><span class="glyphicon glyphicon-refresh"></span> Data Aturan</a></li>
            <li><a href="tamu.php?data"><span class="glyphicon glyphicon-phone-alt"></span> Data Tamu</a></li>
			<li><a href="user.php?data"><span class="glyphicon glyphicon-user"></span> Data User</a></li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-print"></span> Laporan <b class="caret"></b></a>
				<ul class="dropdown-menu">
				  <li><a href="lap.php?diagnosa" target="_blank">Lap. Data Diagnosis</a></li>
				  <li><a href="lap.php?solusi" target="_blank">Lap. Data Penyakit & Solusi</a></li>
				  <li><a href="lap.php?gejala" target="_blank">Lap. Data Gejala</a></li>
				</ul>
			  </li>
			<li><a href="loginout.php" onclick="return confirm('Yakin Mau Logout ?');"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
			  
          </ul>
        </div>
                   
      </div>
	 
	</nav>
<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
	 selector: "textarea",
	theme: "modern",
	plugins: [
		 "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
		 "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
		 "save table contextmenu directionality emoticons template paste textcolor"
   ],
   content_css: "css/content.css",
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
   style_formats: [
		{title: 'Bold text', inline: 'b'},
		{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
		{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
		{title: 'Example 1', inline: 'span', classes: 'example1'},
		{title: 'Example 2', inline: 'span', classes: 'example2'},
		{title: 'Table styles'},
		{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
	]
 });
</script>
	<div class="container">
	  <!-- Main hero unit for a primary marketing message or call to action -->
	  <div class="">
