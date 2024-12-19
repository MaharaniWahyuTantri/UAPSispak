<?php include('inc.session.php'); ?>
<?php include('inc.koneksi.php'); ?>
<?php include('atas.php'); ?>
<?php if(isset($_GET['data'])){ ?>

<h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Data User <a class="btn btn-success btn-sm add" href="user.php?entri"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah Data</a></h2>
<hr>

<table class="table table-bordered table-hover table-striped">
<thead>
		<tr>
	<th style="text-align:center;">No</th>
	<th style="text-align:center;">Nama Lengkap</th>
	<th style="text-align:center;">Username</th>
	<th style="text-align:center;">Aksi</th>
</tr>
	</thead>
	
<?php 
// Menggunakan mysqli_query dan mysqli_fetch_array
$sql = "SELECT * FROM admin";
$rs = mysqli_query($koneksi, $sql); 
$no = 1; 
while($row = mysqli_fetch_array($rs)){ ?>
<tr>
	<td align="center"><?php echo $no; ?></td>
	<td><?php echo $row['nmuser']; ?></td>
	<td><?php echo $row['nmlogin']; ?></td>
	<td align="center">
		<a title="Edit Data" class="btn btn-success btn-sm" href="user.php?edit&id=<?php echo $row[0]; ?>"><span class="glyphicon glyphicon-pencil"></span> </a> 
		<a title="Hapus Data" href="user.php?delete&id=<?php echo $row[0]; ?>" onclick="return confirm('Yakin Mau Hapus ?');" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> </a>
	</td>
</tr>
<?php	$no++; } ?>
</table>
<?php } ?>

<?php
	if(isset($_GET['delete'])){
		$id = $_GET['id'];
		// Menggunakan mysqli_query untuk menghapus data
		$sql = "DELETE FROM admin WHERE id='$id'";
		mysqli_query($koneksi, $sql);
		echo '<script type="text/javascript">
			//<![CDATA[
			window.location="?data"
			//]]>
		</script>';
	}
?>

<?php if(isset($_GET['entri'])){ ?>

<div class="panel panel-default">
  
  <div class="panel-heading">
              <h3 class="panel-title"><span class="glyphicon glyphicon-plus"></span> Tambah Data User</h3>
            </div>
			
<div class="panel-body">
<form class="form-horizontal" method="post" action="">

<div class="form-group">
                    <label class="col-sm-2 control-label">Nama Lengkap</label>
                    <div class="col-sm-4">
					<input class="form-control" autofocus required type="text" name="nm" value="" />
					</div>
		</div>
		
		<div class="form-group">
                    <label class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-4">
					<input class="form-control" required type="text" name="nmlogin" value="" />
					</div>
		</div>
		
		<div class="form-group">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-4">
					<input class="form-control" required type="password" name="pslogin" value="" />
					</div>
		</div>
		
		<div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                <button name="save" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Simpan</button>
				<a href="?data" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Kembali</a>
                </div> 
		</div>	

</form>
</div>
</div>

<?php
	if(isset($_POST['save'])){
		$nm = $_POST['nm'];
		$nmlogin = $_POST['nmlogin'];
		$pslogin = $_POST['pslogin'];
		// Menambahkan data user baru
		$sql = "INSERT INTO admin (id, nmuser, nmlogin, pslogin) VALUES ('', '$nm', '$nmlogin', MD5('$pslogin'))";
		mysqli_query($koneksi, $sql);
		echo '<script type="text/javascript">
			//<![CDATA[
			alert("Data User Berhasil Disimpan");
			window.location="?data"
			//]]>
		</script>';
	}
}
?>

<?php if(isset($_GET['edit'])){ 
	$sql = "SELECT * FROM admin WHERE id='$_GET[id]'";
	$rs = mysqli_query($koneksi, $sql);
	$row = mysqli_fetch_array($rs);
?>

<div class="panel panel-default">
  
  <div class="panel-heading">
              <h3 class="panel-title"><span class="glyphicon glyphicon-plus"></span> Edit Data User</h3>
            </div>
			
<div class="panel-body">
<form class="form-horizontal" method="post" action="">

<div class="form-group">
                    <label class="col-sm-2 control-label">Nama Lengkap</label>
                    <div class="col-sm-4">
					<input class="form-control" type="text" name="nm" value="<?php echo $row['nmuser']; ?>" />
					</div>
		</div>
		
		<div class="form-group">
                    <label class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-4">
					<input class="form-control" type="text" name="nmlogin" value="<?php echo $row['nmlogin']; ?>" />
					</div>
		</div>
		
		<div class="form-group">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-4">
					<input class="form-control" type="password" name="pslogin" value="" placeholder="Kosongkan Jika Tidak Diganti"/>
					</div>
		</div>
		
		<div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                <button name="save" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Simpan</button>
				<a href="?data" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Kembali</a>
                </div> 
		</div>	

</form>
</div>
</div>

<?php 
	if(isset($_POST['save'])){
		$nm = $_POST['nm'];
		$nmlogin = $_POST['nmlogin'];
		$pslogin = $_POST['pslogin'];
		if($pslogin == ""){
			$sql = "UPDATE admin SET nmuser='$nm', nmlogin='$nmlogin' WHERE id='$_GET[id]'";
			mysqli_query($koneksi, $sql);
			echo '<script type="text/javascript">
				//<![CDATA[
				alert("Data User Berhasil Diubah");
				window.location="?data"
				//]]>
			</script>';
		}else{
			$sql = "UPDATE admin SET nmuser='$nm', nmlogin='$nmlogin', pslogin=MD5('$pslogin') WHERE id='$_GET[id]'";
			mysqli_query($koneksi, $sql);
			echo '<script type="text/javascript">
				//<![CDATA[
				alert("Data User Berhasil Diubah");
				window.location="?data"
				//]]>
			</script>';
		}
	}
}
?>

<?php include('bawah.php'); ?>
