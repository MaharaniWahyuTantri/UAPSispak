<?php include('inc.session.php'); ?>
<?php include('atas.php'); ?>
<?php if(isset($_GET['home'])){  ?>
<div class="alert alert-info">
<h3>Selamat Datang Pada Halaman Administrator</h3>
<p align="justify">
  Aplikasi sistem pakar ini dibangun untuk membantu para pakar yang ada di Indonesia dalam bidang ilmu kesehatan khususnya
  di dalam specialis penyakit gigi dan mulut dimana para pengguna atau masyarakat bisa langsung memeriksa penyakit gigi dan 
  mulut melalui sistem ini sehingga tidak memerlukan biaya yang mahal dalam melakukan pemeriksaan penyakit yang ada dalam kehidupan
  sehari-hari pengguna.</p>
</div>
<div class="alert alert-warning">
<h3>Petunjuk Penggunaan Aplikasi</h3>
<p align="justify">
  1. Pilih menu yang ingin dilakukan pengolahan data <br>
  2. Inputkan data dengan benar <br>
  3. Tekan tombol submit jika telah selasai melakukan pengisian data <br>
  4. Logout sebelum menutup browser
  </p>
</div>
<div class="alert alert-danger">
<h3>Kebijakan Pengguna Aplikasi</h3>
<p align="justify">
  1. Jaga keamanan username dan password <br>	
  2. Isi data dengan kebenaran <br>
  3. Lakukan logout sebelum menutup browser
  </p>
</div>
<?php } ?>
<?php include('bawah.php'); ?>
