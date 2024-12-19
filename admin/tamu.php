<?php include('inc.session.php'); ?>
<?php include('inc.koneksi.php'); ?>
<?php include('atas.php'); ?>

<?php if(isset($_GET['data'])){ ?>

<h2><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> Data Tamu</h2>
<hr>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="example">
    <thead>
        <tr>
            <th style="text-align:center;">No</th>
            <th style="text-align:center;">Nama</th>
            <th style="text-align:center;">Email</th>
            <th style="text-align:center;">Isi Pesan</th>
            <th style="text-align:center;">Aksi</th>
        </tr>
    </thead>
    <tbody>
<?php
    // Menggunakan mysqli_query() untuk mengambil data dari database
    $sql = "SELECT * FROM buku_tamu";
    $rs = mysqli_query($koneksi, $sql); // Mengganti mysql_query dengan mysqli_query
    $no = 1;
    while($row = mysqli_fetch_array($rs)) { ?>
        <tr class="odd gradeX">
            <td style="text-align:center;"><?php echo $no; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['isi']; ?></td>
            <td style="text-align:center;">
                <a title="Hapus Data" href="?hapus&id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin Mau Hapus ?');" class="btn btn-danger btn-sm">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
<?php 
        $no++; 
    } 
?>
    </tbody>
</table>

<?php } ?>

<?php
    // Menghapus data tamu
    if(isset($_GET['hapus'])){
        $id = $_GET['id'];
        // Menggunakan mysqli_query() untuk eksekusi query hapus
        $sql = "DELETE FROM buku_tamu WHERE id='$id'";
        mysqli_query($koneksi, $sql); // Mengganti mysql_query dengan mysqli_query

        echo '<script type="text/javascript">
            window.location="?data"
        </script>';
    }
?>

<?php include('bawah.php'); ?>
