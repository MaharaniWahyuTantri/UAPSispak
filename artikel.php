<?php include "conf/inc.koneksi.php"; ?>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><span class="glyphicon glyphicon-info-sign"></span> Informasi</h3>
  </div>
  <div class="panel-body">
    <?php
    // Query untuk mengambil artikel yang valid
    $sql = "SELECT * FROM artikel WHERE ket='Y' ORDER BY id ASC LIMIT 10";
    
    // Eksekusi query dengan mysqli_query
    $rs = mysqli_query($koneksi, $sql);

    // Cek jika query berhasil
    if ($rs) {
        // Ambil data baris satu per satu
        while ($row = mysqli_fetch_array($rs)) {
    ?>
      <a href="?page=read&id=<?php echo $row['id']; ?>" class="list-group-item">
        <img style="float:left;margin-right:20px;" src="news/<?php echo $row['foto']; ?>" class="image-rounded" width="120" height="80"/>
        <h4 class="list-group-item-heading"><?php echo $row['judul']; ?></h4>
        <p class="list-group-item-text-justify">
          <?php echo substr($row['isi'], 0, 350); ?>
        </p>
      </a>
    <?php
        }
    } else {
        // Tampilkan pesan kesalahan jika query gagal
        echo "Terjadi kesalahan saat mengambil data artikel: " . mysqli_error($koneksi);
    }
    ?>
  </div>
</div>
