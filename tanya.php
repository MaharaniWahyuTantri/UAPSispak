<div class="panel panel-default">
  <div class="panel-heading">
              <h3 class="panel-title"><span class="glyphicon glyphicon-book"></span> Buku Tamu</h3>
            </div>
<div class="panel-body">
  
  
<form class="form-horizontal" method="post" action="">
<div class="form-group">
                    <label class="col-sm-3 control-label">Nama</label>
                    <div class="col-sm-9">
					<input class="form-control"  autofocus required type="text" name="a" value=""  />
					</div>
		</div>
<div class="form-group">
                    <label class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
					<input class="form-control"  required type="email" name="b" value=""  />
					</div>
		</div>

<div class="form-group">
                    <label class="col-sm-3 control-label">Isi Pesan</label>
                    <div class="col-sm-9">
					<textarea name="c" class="form-control" row="3"></textarea>
					</div>
		</div>
		
		<div class="form-group">
                <label class="col-sm-3 control-label"></label>
                <div class="col-sm-9">
                <button name="kirim" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Kirim</button>				
                </div> 
		</div>	

</form>


<?php include "conf/inc.koneksi.php"; ?>
<?php	if(isset($_POST['kirim'])){
		$a=$_POST['a']; 
		$b=$_POST['b'];
		$c=$_POST['c']; 
		
		$query=mysql_query("insert into buku_tamu values('','$a','$b','$c')")or die(mysql_error());
		if($query){
	echo "<script>alert('Berhasil Dikirim')</script>";
	echo "<meta http-equiv='refresh' content='0; url=?page=guest'>";
	}else{
	echo "<script>alert('Gagal Dikirim')</script>";
	echo "<meta http-equiv='refresh' content='0; url=?page=guest'>";
		}
		
		
		
		
		} ?>
  </div>
</div>
